<?php

namespace App\Http\Controllers\Front;

use App\Model\Address;
use App\Model\Admin\Admin;
use App\Model\Order;
use App\Notifications\OrderNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;

class CheckoutController extends BaseController
{
    public function checkout(Request $request){
        if(auth()->check()){
            $shipping_address = Address::where('user_id',auth()->check()?auth()->user()->id:'')->where('type','SHIPPING')->latest()->first();
            $billing_address = Address::where('user_id',auth()->check()?auth()->user()->id:'')->where('type','BILLING')->latest()->first();
        }else{
            $shipping_address = isset($_COOKIE['shipping_address'])?(object)unserialize($_COOKIE['shipping_address']):null;
            $billing_address = isset($_COOKIE['billing_address'])?(object)unserialize($_COOKIE['billing_address']):null;
        }
        return view(parent::loadViewData('front.cart.checkout'),compact('shipping_address','billing_address'));
    }

    public function checkoutStore(Request $request){
        $shipping_address = auth()->check() ? Address::where('user_id',auth()->user()->id)
            ->where('type','SHIPPING')->latest()->first() : unserialize($_COOKIE['shipping_address']);
        $this->validate($request,[
            'meat_condition'=>'required|in:poleko,na_poleko',
            'meat_state'=>'required|in:with_skin,without_skin',
            'delivery_date'=>'required|date|after:'.date('m-d-Y'),
            'delivery_time'=>'required',
        ]);
        if(auth()->check() && !$shipping_address = Address::where('user_id',auth()->user()->id)->where('type','SHIPPING')->latest()->first()){
            $request->session()->flash('error', 'Please Provide Shipping Address. Billing Address Is Optional');
            return redirect()->back();
        }
        if(!auth()->check() && !isset($_COOKIE['shipping_address'])){
            $request->session()->flash('error', 'Please Provide Shipping Address. Billing Address Is Optional');
            return redirect()->back();
        }
        try {
            $carts = get_price_check_coupon();
            $shipping_address = auth()->check() ? Address::where('user_id',auth()->user()->id)
            ->where('type','SHIPPING')->latest()->first() : unserialize($_COOKIE['shipping_address']);
            $billing_address = auth()->check() ? Address::where('user_id',auth()->user()->id)
            ->where('type','BILLING')->latest()->first() : null;
       // Create new order
       $cdt = isset($carts['coupon_discount_total'])?$carts['coupon_discount_total']: 0;
       $cd = isset($carts['coupon_discount']) ?  $carts['coupon_discount'] : 0;
       $order = Order::create([
            'user_id' => auth()->check() ? auth()->user()->id : 0,
            'full_names' => auth()->check() ? auth()->user()->name:$shipping_address['full_name'],
            'payment_option' => 'cash_on_delivery',
            'order_note' => $request->order_note,
            'delivery_time' => $request->delivery_time,
            'delivery_date' => $request->delivery_date,
            'meat_condition' => $request->meat_condition,
            'meat_state' => $request->meat_state,
            'shipping_price' => $shipping_address != '' && $shipping_address['from_valley'] == 'inside' ? 0  :$carts['shipping'],
            'shipping_address'=>serialize($shipping_address),
            'billing_address'=>$billing_address != null ? serialize($billing_address): null,
            'coupon_discounts' =>$cd,
            'coupon_discounts_total' => $cdt,
            'total_discounts' => $cdt,
            'sub_totals' => \Cart::getSubTotal(),
            'grand_totals' => $carts['total'],
            'status' => 'Pending',
        ]);

        // Attach products
        $cartContents = \Cart::getContent();
        if ($cartContents) {


            foreach ($cartContents as $cartContent) {
            $order->products()->attach($cartContent->id,
                [
                'quantity' => $cartContent->quantity,
                'price' => $cartContent->price,
                ]
            );
            }
        }
        \Cart::clear();
        session_unset();
        $letter = collect(['title'=>'New Order Has Arrived By on Date'.date('Y-m-d H:i:s'),
        'body'=>'Total '.\Cart::getContent()->count().' Products Ordered By :-'.$shipping_address['full_name']]);
        Notification::send(Admin::find(1),new OrderNotification($letter));
        $request->session()->flash('success','Your Order Has Been Placed Successfully. We Will Contact You Soon');
        return redirect()->route('index');
        } catch (\Exception $exception) {
        \Log::alert('At Product Checkout '.$exception->getMessage());
        $request->session()->flash('error','Opps Something Went Wrong With Procceding To Checkout Please Contact System Administrator');
        return redirect()->route('index');
        }
        return redirect()->route('index');
    }
}
