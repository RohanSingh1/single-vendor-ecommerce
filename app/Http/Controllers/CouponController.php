<?php

namespace App\Http\Controllers;

use App\Model\Coupon;
use App\Model\Product;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;

class CouponController extends Controller
{
    public function index()
    {
        return view('backend.coupons.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function apiCoupon()
    {
        $coupons = Coupon::all();
        //dd($coupons);
        return Datatables::of($coupons)
            ->addColumn('action', function ($coupon) {
                return '

                <a href="'.route("admin.coupons.show",$coupon->id ).'" class="btn btn-xs btn-info " style="float:left; margin-right:5px" ><i class ="fa fa-eye"></i></a>
           <a href="coupons/' . $coupon->id . '/edit" class="btn btn-xs btn-info " style="float:left; margin-right:5px" ><i class ="fa fa-edit"></i></a>
            <form action= "' . route('admin.coupons.destroy', $coupon->id) . '" method="POST" accept-charset ="UTF-8" class="form-inline">
                <input type="hidden" value="DELETE" name="_method">
                <span class="input-group-btn">
                <button class="btn btn-danger btn-xs delete-item" type="submit" value="delete"><i class ="fa fa-trash"></i></button>
                </span>
                <input type="hidden" value="' . csrf_token() . '" name="_token">
                <input type="hidden" value="' .$coupon->id . '" name="id">
            </form>


           ';
            })
            ->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $products = Product::where('status',1)->get();
        return view('backend.coupons.create',compact('products'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if($request->type == 'percentage_discounts'){
            $type_rule = 'required|numeric|min:1|max:100';
        }else{
            $type_rule = 'required|numeric|min:1';
        }

        $this->validate($request,[
            'coupon_name'=>'required',
            'type'=>'required|in:flat_discounts,percentage_discounts',
            'expiry_date'=>'required|after_or_equal:now|required_if:go_to_school_college,yes',
            'value'=>$type_rule,
            'status'=>'required|boolean',
        ]);

        $coupon_code = strtoupper(str_slug($request->coupon_name).'-'.rand(0,9999).substr(str_slug($request->coupon_name),3,6));



        $coupon = Coupon::create([
            'user_id'=>auth()->check() ? auth()->user()->id:1,
            'coupon_name'=>$request->coupon_name,
            'coupon_code'=>$coupon_code,
            'expiry_date'=>$request->expiry_date,
            'value'=>$request->value,
            'type'=>$request->type,
            'status'=>$request->status,
        ]);

        $coupon->products()->sync($request->products);
        $request->session()->flash('success','Success The Coupon Has Been Saved');
        return redirect()->route('admin.coupons.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $coupon = Coupon::findOrfail($id);
        return view('backend.coupons.show',compact('coupon'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request,$id)
    {
        if(!$coupon = Coupon::find($id)){
            $request->session()->flash('error','Sorry The Selected Coupon Has Found Or Has Been Deleted');
            return redirect()->route('admin.coupons.index');
        }
        $products = Product::get();
        return view('backend.coupons.edit',compact('coupon','products'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if($request->type == 'percentage_discounts'){
            $type_rule = 'required|numeric|min:1|max:100';
        }else{
            $type_rule = 'required|numeric|min:1';
        }

        $this->validate($request,[
            'coupon_name'=>'required',
            'type'=>'required|in:flat_discounts,percentage_discounts',
            'expiry_date'=>'required|after_or_equal:now',
            'value'=>$type_rule,
            'products'=>'required',
            'status'=>'required|boolean',
        ]);

        if(!$coupon = Coupon::find($id)){
            $request->session()->flash('error','Sorry The Selected Coupon Has Found Or Has Been Deleted');
            return redirect()->route('dashboard.coupons.index');
        }

        $coupon_code = strtoupper(str_slug($request->coupon_name).'-'.rand(0,9999).substr(str_slug($request->coupon_name),3,6));





        $coupon->update([
            'coupon_name'=>$request->coupon_name,
            'coupon_code'=>$coupon_code,
            'expiry_date'=>$request->expiry_date,
            'value'=>$request->value,
            'type'=>$request->type,
            'status'=>$request->status,
        ]);
        $coupon->products()->sync($request->products);
        $request->session()->flash('success','Success The Coupon Has Been Update');
        return redirect()->route('admin.coupons.index');
    }

    public function destroy(Request $request,$id)
    {
        if(!$coupon = Coupon::find($request->id)){
            $request->session()->flash('error','Sorry The Selected Coupon Has Found Or Has Been Deleted');
            return redirect()->route('admin.coupons.index');
        }

        $coupon->delete();
        $coupon->products()->sync([]);
        $request->session()->flash('success','SuccessFully Deleted');
        return redirect()->route('admin.coupons.index');
    }
}
