<?php

namespace App\Http\Controllers\Front;

use App\Model\Address;
use App\Model\Admin\Admin;
use App\Model\District;
use App\Model\Location;
use App\Model\Order;
use App\Model\Province;
use App\Notifications\OrderNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;

class CheckoutController extends BaseController
{
    public function getDistrictNLocalLevel(Request $request){
            if($request->selected_province_id != ''){
                $response['error'] = true;
                $data['district_id'] = District::where('province_id',$request->selected_province_id)->get();
                $data['province_id'] = Province::all();
                $data['province_id_now'] = $request->selected_province_id;
            }
            if($request->selected_district_id != ''){
                $data['district_id'] = District::where('province_id',$request->selected_province_id)->get();
                $data['province_id'] = Province::all();
                $data['province_id_now'] = $request->selected_province_id;
                $data['district_id_now'] = $request->selected_district_id;
                $data['locations'] = Location::where('district_id',$request->selected_district_id)->get();
            }
            $response['html'] = view('front.layouts.locations')->with('data',$data)->render();
            $response['error'] = false;


        return response()->json(json_encode($response,true));
    }

    public function checkout(Request $request){
        if(auth()->check()){
            $shipping_address = Address::where('user_id',auth()->check()?auth()->user()->id:'')->where('type','SHIPPING')->latest()->first();
            $billing_address = Address::where('user_id',auth()->check()?auth()->user()->id:'')->where('type','BILLING')->latest()->first();
        }else{
            $shipping_address = isset($_COOKIE['shipping_address'])?(object)unserialize($_COOKIE['shipping_address']):null;
            $billing_address = isset($_COOKIE['billing_address'])?(object)unserialize($_COOKIE['billing_address']):null;
        }
        $data['district_id'] = District::all();
        $data['locations'] = Location::all();
        $data['province_id'] = Province::all();
        return view(parent::loadViewData('front.cart.checkout'),compact('data','shipping_address','billing_address'));
    }

    public function checkoutStore(Request $request){
        $this->validate($request,[
            's_full_name'=>'required',
            's_email'=>'required',
            's_phone'=>'required',
            's_address1'=>'required',
            'from_valley'=>'required|in:inside,outside',
            'meat_condition'=>'nullable|in:poleko,na_poleko',
            'meat_state'=>'nullable|in:with_skin,without_skin',
            'delivery_date'=>'required|date|after:'.date('m-d-Y'),
            'delivery_time'=>'required',
            'province_id'=>'required|exists:provinces,id',
            'district_id'=>'required|exists:districts,id',
            'locations'=>'required|exists:locations,id',
        ]);
        $addressData = [
            'type' => 'SHIPPING',
            'user_id' => auth()->check() ? auth()->user()->id:0,
            'full_name' => $request->s_full_name,
            'email' => $request->s_email,
            'phone' => $request->s_phone,
            'from_valley' => $request->from_valley,
            'address1' => $request->s_address1,
            'address2' => $request->s_address2,
            'province_id' => $request->province_id,
            'district_id' => $request->district_id,
            'locations' => $request->locations,
        ];
        $location = Location::find($request->locations);
        if(auth()->check()){
            if($saddress = Address::where('user_id',auth()->user()->id)->where('type','SHIPPING')
            ->orderBy('id', 'DESC')->get()[0]){
                $saddress->update($addressData);
            }else{
                Address::create($addressData);
            }
        }
            setcookie('shipping_address', serialize($addressData), time()+3600);
        $shipping_address = auth()->check() ? Address::where('user_id',auth()->user()->id)
            ->where('type','SHIPPING')->latest()->first() : $addressData;
        if(auth()->check() && !$shipping_address = Address::where('user_id',auth()->user()->id)->where('type','SHIPPING')->latest()->first()){
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
            'order_track_id' => 'OD'.rand(0,999999999),
            'order_note' => $request->order_note,
            'delivery_time' => $request->delivery_time,
            'delivery_date' => $request->delivery_date,
            'meat_condition' => $request->meat_condition,
            'meat_state' => $request->meat_state,
            'shipping_price' => $shipping_address != '' && $shipping_address['from_valley'] == 'inside' ? 0  :$location->price,
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

        $options = array(
            'cluster' => 'ap2',
            'useTLS' => true
          );
          $pusher = new \Pusher\Pusher(
            '920fbe198f23cfa1e146',
            '41364937430cb6bdf5a7',
            '1275466',
            $options
          );

        $letter = collect(['title'=>'New Order Has Arrived By on Date '.date('Y-m-d H:i:s'),
        'body'=>'Total '.\Cart::getContent()->count().' Products Ordered By :-'.$shipping_address['full_name']]);
        Notification::send(Admin::find(1),new OrderNotification($letter));
        $data['message'] = $letter;
        $pusher->trigger('my-channel', 'my-event', $data);
        \Cart::clear();
        session_unset();
        $request->session()->flash('success','Your Order Has Been Placed Successfully. We Will Contact You Soon. Your Track Order Id Is '.'('.$order->order_track_id.')');
        return redirect()->route('index');
        } catch (\Exception $exception) {
        \Log::alert('At Product Checkout '.$exception->getMessage()); 
        $request->session()->flash('error','Opps Something Went Wrong With Procceding To Checkout Please Contact System Administrator');
        return redirect()->route('index');
        }
        return redirect()->route('index');
    }
}
