<?php

namespace App\Http\Controllers\DeliveryBoys;

use App\Model\Order;
use App\Model\Product;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use App\Http\Controllers\Controller;
use App\Model\DeliveryName;

class OrderController extends Controller
{

    public function __construct()
    {
        $this->middleware(['auth','DeliveryRoleValidation']);
    }

    public function index() 
    {
        return view('backend.delivery_boys.orders.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function apiorders()
    {
        $orders = Order::where('delivery_boy_id',auth('admin')->user()->id)->latest()->get();
        //dd($orders);
        return Datatables::of($orders)
        ->setRowId(function ($modal) {
            return $modal->id;
        })
        ->addColumn('full_names', function ($data) {
           return $data->user->f_name.' '. $data->user->l_name.'<br> Email:'.$data->user->email;
        })
        ->editColumn('sub_totals', function($data) {
            if($data->currency_type == 'usd'){
                return round($data->sub_totals/119,2);
            }else{
                return round($data->sub_totals,2);
            }
        })
        ->editColumn('total_discounts', function($data) {
            if(round($data->currency_type) == 'usd'){
                return round($data->total_discounts/119,2);
            }else{
                return round($data->total_discounts,2);
            }
        })
        ->editColumn('grand_totals', function($data) {
            if(round($data->currency_type) == 'usd'){
                return round($data->grand_totals/119,2);
            }else{
                return round($data->grand_totals,2);
            }
        })
        ->addColumn('status', function ($data) {
           return ucfirst($data->status);
        })
        ->addColumn('products', function ($data) {
            return $data->products->count();
            // $product_now = '';
            // foreach($data->products as $key=>$product){
            //     $product_now .= $product->name.' <br>';
            // }
            // return $product_now;
        })
        ->addColumn('product_id', function ($data) {
            if ($prs = Product::find($data->product_id)) {
                return ' <a href="' .route('product.show',$prs->slug). '" target="_blank">'.$prs->name.'</a>';
            } else {
                return 'Product Not Found';
            }
        })
            ->addColumn('action', function ($orders) {
                return '
                <a href="'.route("admin.delivery_orders.show",$orders->id ).'" class="btn btn-xs btn-info " style="float:left; margin-right:5px" ><i class ="fa fa-eye"></i></a>
           <a href="delivery_orders/' . $orders->id . '/edit" class="btn btn-xs btn-info " style="float:left; margin-right:5px" ><i class ="fa fa-edit"></i></a>
            <form action= "' . route('admin.delivery_orders.destroy', $orders->id) . '" method="POST" accept-charset ="UTF-8" class="form-inline">
                <input type="hidden" value="DELETE" name="_method">
                <span class="input-group-btn">
                <button class="btn btn-danger btn-xs delete-item" type="submit" value="delete"><i class ="fa fa-trash"></i></button>
                </span>
                <input type="hidden" value="' . csrf_token() . '" name="_token">
                <input type="hidden" value="' .$orders->id . '" name="id">
            </form>';
            })
            ->rawColumns(['product_id', 'action','full_names','products','status'])
            ->addIndexColumn()
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
        $order = Order::findOrfail($id);
        return view('backend.delivery_boys.orders.show',compact('order'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request,$id)
    {
        if(!$order = Order::find($id)){
            $request->session()->flash('error','Sorry The Selected orders Has Found Or Has Been Deleted');
            return redirect()->route('admin.delivery_orders.index');
        }
        $products = Product::get();
        $delivery_name = DeliveryName::where('status',1)->get();
        return view('backend.delivery_boys.orders.edit',compact('order','products','delivery_name'));
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
            'full_names'=>'required|string|max:200',
            'products'=>'required|exists:products,id',
            'status'=>'required'
        ]);

        if(!$order = Order::find($id)){
            $request->session()->flash('error','Sorry The Selected orders Has Found Or Has Been Deleted');
            return redirect()->route('admin.delivery_orders.index');
        }

        $carts = get_price_check_coupon();

         $order->update([
             'full_names' => $request->full_names,
             'payment_option' => 'cash_on_delivery',
             'shipping_price' => $request->shipping_price,
             'total_discounts' => $request->total_discounts,
             'sub_totals' => $request->sub_totals,
             'grand_totals' => $request->grand_totals,
             'status' => $request->status,
         ]);

         $order->products()->sync($request->products);
        $request->session()->flash('success','Success The Order Has Been Update');
        return redirect()->route('admin.delivery_orders.index');
    }

    public function destroy(Request $request,$id)
    {
        if(!$order = Order::find($request->id)){
            $request->session()->flash('error','Sorry The Selected Order Has Found Or Has Been Deleted');
            return redirect()->route('admin.delivery_orders.index');
        }

        $order->delete();
        $order->products()->sync([]);
        $request->session()->flash('success','SuccessFully Deleted');
        return redirect()->route('admin.delivery_orders.index');
    }
}
