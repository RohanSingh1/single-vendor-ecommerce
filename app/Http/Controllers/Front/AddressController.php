<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Model\Address;
use Illuminate\Http\Request;

class AddressController extends Controller
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
            'user_id' => 1,
            'full_name' => $request->s_full_name,
            'email' => $request->s_email,
            'phone' => $request->s_phone,
            'address1' => $request->s_address1,
            'address2' => $request->s_address2,
        ];
        $request->session()->flash('success','SHIPPING Address Added Successfully');
        Address::updateOrCreate(['user_id' => auth()->id()], $addressData);
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
            'user_id' => 1,
            'full_name' => $request->b_full_name,
            'email' => $request->b_email,
            'phone' => $request->b_phone,
            'address1' => $request->b_address1,
            'address2' => $request->b_address2,
        ];
        Address::updateOrCreate(['user_id' => auth()->id(),'type'=>'BILLING'], $addressData);
        $request->session()->flash('success','Billing Address Added Successfully');
        return redirect()->back();
    }

}
