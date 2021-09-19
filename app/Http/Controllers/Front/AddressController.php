<?php

namespace App\Http\Controllers\Front;

use App\Model\Address;
use Illuminate\Http\Request;

class AddressController extends BaseController
{
    public function addShippingAddress(Request $request){
        $this->validate($request,[
            's_full_name'=>'required',
            's_email'=>'required',
            's_phone'=>'required',
            's_address1'=>'required',
        ]);
        $addressData = [
            'type' => 'SHIPPING',
            'user_id' => auth()->check() ? auth()->user()->id:0,
            'full_name' => $request->s_full_name,
            'email' => $request->s_email,
            'phone' => $request->s_phone,
            'address1' => $request->s_address1,
            'address2' => $request->s_address2,
        ];
        $request->session()->flash('success','SHIPPING Address Added Successfully');
        if(auth()->check()){
            Address::updateOrCreate(['user_id' => auth()->id(),'type'=>'SHIPPING'], $addressData);
        }else{
            setcookie('shipping_address', serialize($addressData), time()+3600);
        }
        return redirect()->back();
    }

    public function addBillingAddress(Request $request){
        $this->validate($request,[
            'b_full_name'=>'required',
            'b_email'=>'required',
            'b_phone'=>'required',
            'b_address1'=>'required',
        ]);

        $addressData = [
            'type' => 'BILLING',
            'user_id' => auth()->check() ? auth()->user()->id:0,
            'full_name' => $request->b_full_name,
            'email' => $request->b_email,
            'phone' => $request->b_phone,
            'address1' => $request->b_address1,
            'address2' => $request->b_address2,
        ];
        if(auth()->check()){
            Address::updateOrCreate(['user_id' => auth()->id(),'type'=>'BILLING'], $addressData);
        }else{
            setcookie('billing_address', serialize($addressData), time()+3600);
        }
        $request->session()->flash('success','Billing Address Added Successfully');
        return redirect()->back();
    }

    public function myaddress(Request $request){
        $shipping_address = Address::where('type','SHIPPING')->where('user_id',auth()->user()->id)->first();
        $billing_address = Address::where('type','BILLING')->where('user_id',auth()->user()->id)->first();
        return view(parent::loadViewData('front.user.myaddress'),compact('shipping_address','billing_address'));
    }

    public function editmyaddress(Request $request){
        $shipping_address = Address::where('type','SHIPPING')->where('user_id',auth()->user()->id)->first();
        $billing_address = Address::where('type','BILLING')->where('user_id',auth()->user()->id)->first();
        return view(parent::loadViewData('front.user.editmyaddress'),compact('shipping_address','billing_address'));
    }

    public function updateAddress(Request $request){
        $this->validate($request,[
            'name'=>'required|max:120',
            'phone_no'=>'required|min:10',
            'address_1'=>'required',
            'address_2'=>'required',
        ]);

        auth()->user()->update([
            'name'=>$request->name,
            'phone_no'=>$request->phone_no,
            'address_1'=>$request->address_1,
            'address_2'=>$request->address_2,
        ]);

        $request->session()->flash('success','Address Has Been Successfully Updated');
        return redirect()->back();
    }

}
