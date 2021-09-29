<?php

namespace App\Http\Controllers;

use App\helpers\SaveImage;
use App\Model\Deal;
use App\Model\Product;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;

class DealController extends Controller
{
    public function index()
    {
        return view('backend.deals.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function apiDeal()
    {
        $deals = Deal::all();
        //dd($deals);
        return Datatables::of($deals)
        ->addColumn('image', function ($data) {
            if ($data->image !='') {
                return ' <a href="' . asset('storage/uploads/Deal/'.$data->image) . '"><img src="' . asset('storage/uploads/Deal/'.$data->image) . '" width="50px" ></a>';
            } else {
                return ' <a href="' . asset('no-image.jpg') . '" target="_blank"> <img src="' . asset('no-image.jpg') . '"  width="50px"></a>';
            }
        })
        ->addColumn('action', function ($deal) {
            return '<a href="'.route("admin.deals.show",$deal->id ).'" class="btn btn-xs btn-info " style="float:left; margin-right:5px" ><i class ="fa fa-eye"></i></a>
            <a href="deals/' . $deal->id . '/edit" class="btn btn-xs btn-info " style="float:left; margin-right:5px" ><i class ="fa fa-edit"></i></a>
                <form action= "' . route('admin.deals.destroy', $deal->id) . '" method="POST" accept-charset ="UTF-8" class="form-inline">
                    <input type="hidden" value="DELETE" name="_method">
                    <span class="input-group-btn">
                    <button class="btn btn-danger btn-xs delete-item" type="submit" value="delete"><i class ="fa fa-trash"></i></button>
                    </span>
                    <input type="hidden" value="' . csrf_token() . '" name="_token">
                    <input type="hidden" value="' .$deal->id . '" name="id">
                </form>';
        })
        ->rawColumns(['image', 'action'])
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
        return view('backend.deals.create',compact('products'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'name'=>'required',
            'expiry_date'=>'required|after_or_equal:now',
            'details'=>'required',
            'status'=>'required|boolean',
        ]);

        if ($request->hasFile('image')) {
            $file_name = SaveImage::save($request->image, 'Deal');
        }
        $deal = Deal::create([
            'name'=>$request->name,
            'slug'=>str_slug($request->name),
            'expiry_date'=>$request->expiry_date,
            'image'=>isset($file_name)?$file_name:null,
            'details'=>$request->details,
            'status'=>$request->status,
        ]);

        $deal->products()->sync($request->products);
        $request->session()->flash('success','Success The Deal Has Been Saved');
        return redirect()->route('admin.deals.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $deal = Deal::findOrfail($id);
        return view('backend.deals.show',compact('deal'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request,$id)
    {
        if(!$deal = Deal::find($id)){
            $request->session()->flash('error','Sorry The Selected Deal Has Found Or Has Been Deleted');
            return redirect()->route('admin.deals.index');
        }
        $products = Product::get();
        return view('backend.deals.edit',compact('deal','products'));
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
            'name'=>'required',
            'expiry_date'=>'required|after_or_equal:now',
            'details'=>'required',
            'status'=>'required|boolean',
        ]);

        if(!$deal = Deal::find($id)){
            $request->session()->flash('error','Sorry The Selected Deal Has Found Or Has Been Deleted');
            return redirect()->route('dashboard.deals.index');
        }

        if ($request->hasFile('image')) {
            $file_name = SaveImage::update($request->image, 'Deal', $deal->image ? $deal->imagePath : '');
            if($deal->image != null && file_exists('storage/Uploads/Deal/'.$deal->image)){
                unlink(base_path().'/public/storage/Uploads/Deal/'.$deal->image);
            }
        } else {
            $file_name = $deal->image;
        }

        $deal->update([
            'name'=>$request->name,
            'slug'=>str_slug($request->name),
            'expiry_date'=>$request->expiry_date,
            'image'=>isset($file_name)?$file_name:$deal->image,
            'details'=>$request->details,
            'status'=>$request->status,
        ]);
        $deal->products()->sync($request->products);
        $request->session()->flash('success','Success The Deal Has Been Update');
        return redirect()->route('admin.deals.index');
    }

    public function destroy(Request $request,$id)
    {
        if(!$deal = Deal::find($request->id)){
            $request->session()->flash('error','Sorry The Selected Deal Has Found Or Has Been Deleted');
            return redirect()->route('admin.deals.index');
        }
        $deal->delete();
        $deal->products()->sync([]);
        if($deal->image != null && file_exists('storage/Uploads/Deal/'.$deal->image)){
            unlink(base_path().'/public/storage/Uploads/Deal/'.$deal->image);
        }
        $request->session()->flash('success','SuccessFully Deleted');
        return redirect()->route('admin.deals.index');
    }
}
