<?php

namespace App\Http\Controllers;

use App\Model\CustomerFeedback as ModelCustomerFeedback;
use App\Model\Product;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;

class CustomerFeedback extends Controller
{
    public function index()
    {
        return view('backend.customerFeedback.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function apiCustomerFeedback()
    {
        $customerFeedback = ModelCustomerFeedback::all();
        //dd($customerFeedback);
        return Datatables::of($customerFeedback)
        ->addColumn('product_id', function ($data) {
            if ($prs = Product::find($data->product_id)) {
                return ' <a href="' .route('product.show',$prs->slug). '" target="_blank">'.$prs->name.'</a>';
            } else {
                return 'Product Not Found';
            }
        })
            ->addColumn('action', function ($customerFeedback) {
                return '

                <a href="'.route("admin.customerFeedback.show",$customerFeedback->id ).'" class="btn btn-xs btn-info " style="float:left; margin-right:5px" ><i class ="fa fa-eye"></i></a>
           <a href="customerFeedback/' . $customerFeedback->id . '/edit" class="btn btn-xs btn-info " style="float:left; margin-right:5px" ><i class ="fa fa-edit"></i></a>
            <form action= "' . route('admin.customerFeedback.destroy', $customerFeedback->id) . '" method="POST" accept-charset ="UTF-8" class="form-inline">
                <input type="hidden" value="DELETE" name="_method">
                <span class="input-group-btn">
                <button class="btn btn-danger btn-xs delete-item" type="submit" value="delete"><i class ="fa fa-trash"></i></button>
                </span>
                <input type="hidden" value="' . csrf_token() . '" name="_token">
                <input type="hidden" value="' .$customerFeedback->id . '" name="id">
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
        $customerFeedback = ModelCustomerFeedback::findOrfail($id);
        return view('backend.customerFeedback.show',compact('customerFeedback'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request,$id)
    {
        if(!$customerFeedback = ModelCustomerFeedback::find($id)){
            $request->session()->flash('error','Sorry The Selected customerFeedback Has Found Or Has Been Deleted');
            return redirect()->route('admin.customerFeedback.index');
        }
        $products = Product::get();
        return view('backend.customerFeedback.edit',compact('customerFeedback','products'));
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
            'contact_no'=>'required|numeric|digits:10',
            'product_id'=>'required|exists:products,id',
            'feedback'=>'required',
        ]);

        if(!$customerFeedback = ModelCustomerFeedback::find($id)){
            $request->session()->flash('error','Sorry The Selected Customer Feedback Has Found Or Has Been Deleted');
            return redirect()->route('dashboard.customerFeedback.index');
        }

        $customerFeedback->update([
            'name' => $request->name,
             'email' => $request->email,
             'contact_no' => $request->contact_no,
             'feedback' => $request->feedback,
             'product_id'=>$request->product_id,
        ]);

        $request->session()->flash('success','Success The customer Feedback Has Been Update');
        return redirect()->route('admin.customerFeedback.index');
    }

    public function destroy(Request $request,$id)
    {
        if(!$customerFeedback = ModelCustomerFeedback::find($request->id)){
            $request->session()->flash('error','Sorry The Selected customer Feedback Has Found Or Has Been Deleted');
            return redirect()->route('admin.customerFeedback.index');
        }

        $customerFeedback->delete();
        $request->session()->flash('success','SuccessFully Deleted');
        return redirect()->route('admin.customerFeedback.index');
    }
}
