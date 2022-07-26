<?php

namespace App\Http\Controllers\Front;

use App\Model\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DashboardController extends BaseController
{
    public function index()
    {
        $data['my_orders'] = Order::where('user_id',auth()->user()->id)->get();
        return view(parent::loadViewData('front.user.dashboard'),compact('data'));
    }

    public function uploadAvatar(Request $request){
        $this->validate($request,[
            'image'=>'required|image|max:1024'
        ]);
        $file_name = auth()->user()->name.'User_'.rand(0,9999).'.'.$request->file('image')->getClientOriginalExtension();
        $request->file('image')->storeAs('uploads'.DIRECTORY_SEPARATOR.'Front'.DIRECTORY_SEPARATOR.'User', $file_name);
        if (auth()->user()->image !=null && Storage::disk('public')->exists('uploads'.DIRECTORY_SEPARATOR.'Front'
                .DIRECTORY_SEPARATOR.'User'. DIRECTORY_SEPARATOR .auth()->user()->image)) {
                    Storage::disk('public')->delete('uploads'.DIRECTORY_SEPARATOR.DIRECTORY_SEPARATOR.'Front'
                    .DIRECTORY_SEPARATOR.'User'. DIRECTORY_SEPARATOR.auth()->user()->image);
                }
        auth()->user()->update(['image'=>$file_name]);
        return redirect()->back();
    }

    public function myorders(){
        $data['my_orders'] = Order::where('user_id',auth()->user()->id)->latest()->get();
        return view(parent::loadViewData('front.user.myorders'), compact('data'));
    }

    public function track_order(Request $request){
        $track = Order::where('order_track_id',$request->get('order_track_id'))->where('user_id',auth()->user()->id)->get();
        if($track->count() == 0){
            $request->session()->flash('error','Sorry Order Not Found With Track Id '.'('.$request->get('order_track_id').')');
            return redirect()->route('front.dashboard');
        }

        $data['my_orders'] = $track;
        return view(parent::loadViewData('front.user.myorders'), compact('data'));
    }

    public function track_order_id_show(Request $request){
        $track = Order::where('order_track_id',$request->get('order_track_id'))->get();
        if($track->count() == 0){
            $request->session()->flash('error','Sorry Order Not Found With Track Id '.'('.$request->get('order_track_id').')');
            return redirect()->back(); 
        }

        $data['my_orders'] = $track;
        return view(parent::loadViewData('front.user.track_order_id_show'), compact('data'));
    }

    public function track_order_id(Request $request){
        return view(parent::loadViewData('front.user.track_order_id'));
    }

}
