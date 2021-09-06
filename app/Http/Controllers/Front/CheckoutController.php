<?php

namespace App\Http\Controllers\Front;

use App\Model\Address;
use App\Model\Order;
use Illuminate\Http\Request;

class CheckoutController extends BaseController
{
    public function checkout(Request $request){
        $shipping_address = Address::where('user_id',1)->where('type','SHIPPING')->latest()->first();
        $billing_address = Address::where('user_id',1)->where('type','BILLING')->latest()->first();
        return view(parent::loadViewData('front.cart.checkout'),compact('shipping_address','billing_address'));
    }

    public function checkoutStore(Request $request){
        if(!$shipping_address = Address::where('user_id',1)->where('type','SHIPPING')->latest()->first()
        || !$billing_address = Address::where('user_id',1)->where('type','BILLING')->latest()->first()){
            $request->session()->flash('error', 'Please Provide Shipping And BILLING Address');
            return redirect()->back();
        }
        try {
            $carts = get_price_check_coupon();
       // Create new order
       $cdt = isset($carts['coupon_discount_total'])?$carts['coupon_discount_total']: 0;
       $cd = isset($carts['coupon_discount']) ?  $carts['coupon_discount'] : 0;

       $order = Order::create([
            'user_id' => 1,
            'full_names' => auth()->check() ? auth()->user()->name:$billing_address->full_name,
            'payment_option' => 'cash_on_delivery',
            'shipping_price' => isset($carts['shipping'])?$carts['shipping']:0,
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
        $request->session()->flash('success','Your Order Has Been Placed Successfully. We Will Contact You Soon');
        \Cart::clear();
        session_unset();
        return redirect()->route('index');
        } catch (\Exception $exception) {
        \Log::alert('At Product Checkout '.$exception->getMessage());
        $request->session()->flash('error','Opps Something Went Wrong With Procceding To Checkout Please Contact System Administrator');
        return redirect()->route('index');
        }
        return redirect()->route('index');
    }
}
