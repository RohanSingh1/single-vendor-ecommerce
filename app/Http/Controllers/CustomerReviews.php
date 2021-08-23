<?php

namespace App\Http\Controllers;

use App\Model\ProductReview as ModelCustomerReviews;
use App\Model\Product;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;

class CustomerReviews extends Controller
{
    public function index()
    {
        return view('backend.customerReviews.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function apicustomerReviews()
    {
        $customerReviews = ModelCustomerReviews::all();
        //dd($customerReviews);
        return Datatables::of($customerReviews)
        ->addColumn('product_id', function ($data) {
            if ($prs = Product::find($data->product_id)) {
                return ' <a href="' .route('product.show',$prs->slug). '" target="_blank">'.$prs->name.'</a>';
            } else {
                return 'Product Not Found';
            }
        })
            ->addColumn('action', function ($customerReviews) {
                return '

                <a href="'.route("admin.customerReviews.show",$customerReviews->id ).'" class="btn btn-xs btn-info " style="float:left; margin-right:5px" ><i class ="fa fa-eye"></i></a>
           <a href="customerReviews/' . $customerReviews->id . '/edit" class="btn btn-xs btn-info " style="float:left; margin-right:5px" ><i class ="fa fa-edit"></i></a>
            <form action= "' . route('admin.customerReviews.destroy', $customerReviews->id) . '" method="POST" accept-charset ="UTF-8" class="form-inline">
                <input type="hidden" value="DELETE" name="_method">
                <span class="input-group-btn">
                <button class="btn btn-danger btn-xs delete-item" type="submit" value="delete"><i class ="fa fa-trash"></i></button>
                </span>
                <input type="hidden" value="' . csrf_token() . '" name="_token">
                <input type="hidden" value="' .$customerReviews->id . '" name="id">
            </form>


           ';
            })
            ->rawColumns(['product_id', 'action'])
            ->make(true);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $customerReviews = ModelCustomerReviews::findOrfail($id);
        return view('backend.customerReviews.show',compact('customerReviews'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request,$id)
    {
        if(!$customerReviews = ModelCustomerReviews::find($id)){
            $request->session()->flash('error','Sorry The Selected customerReviews Has Found Or Has Been Deleted');
            return redirect()->route('admin.customerReviews.index');
        }
        $products = Product::get();
        return view('backend.customerReviews.edit',compact('customerReviews','products'));
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
        $this->validate($request,[
            'name'=>'required|string|max:200',
            'email'=>'required|email|max:200',
            'product_id'=>'required|exists:products,id',
            'comments'=>'required',
        ]);

        if(!$customerReviews = ModelCustomerReviews::find($id)){
            $request->session()->flash('error','Sorry The Selected Customers Review Has Found Or Has Been Deleted');
            return redirect()->route('dashboard.customerReviews.index');
        }

        $customerReviews->update([
            'name' => $request->name,
             'email' => $request->email,
             'comments' => $request->comments,
             'product_id'=>$request->product_id,
        ]);

        $request->session()->flash('success','Success The customers Review Has Been Update');
        return redirect()->route('admin.customerReviews.index');
    }

    public function destroy(Request $request,$id)
    {
        if(!$customerReviews = ModelCustomerReviews::find($request->id)){
            $request->session()->flash('error','Sorry The Selected customers Review Has Found Or Has Been Deleted');
            return redirect()->route('admin.customerReviews.index');
        }

        $customerReviews->delete();
        $request->session()->flash('success','SuccessFully Deleted');
        return redirect()->route('admin.customerReviews.index');
    }
}
