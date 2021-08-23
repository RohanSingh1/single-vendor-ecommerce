<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Brand;
use Yajra\Datatables\Datatables;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
         $this->middleware(['auth:admin']);
          $this->middleware('permission:brand-list');
          $this->middleware('permission:brand-create', ['only' => ['create','store']]);
          $this->middleware('permission:brand-edit', ['only' => ['edit','update']]);
          $this->middleware('permission:brand-delete', ['only' => ['destroy']]);
    }
    public function index()
    {
        return view('backend.brand.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function apiBrand()
    {
        $brands = Brand::all();
        //dd($brands);
        return Datatables::of($brands)
            ->addColumn('action', function ($brand) {
                return '

           <a href="brand/' . $brand->id . '/edit" class="btn btn-xs btn-info " style="float:left; margin-right:5px" ><i class ="fa fa-edit"></i></a>
            <form action= "' . route('admin.brand.destroy', $brand->id) . '" method="POST" accept-charset ="UTF-8" class="form-inline">
                <input type="hidden" value="DELETE" name="_method">
                <span class="input-group-btn">
                <button class="btn btn-danger btn-xs delete-item" type="submit" value="delete"><i class ="fa fa-trash"></i></button>
                </span>
                <input type="hidden" value="' . csrf_token() . '" name="_token">
            </form>


           ';
            })
            ->make(true);
    }
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'brand_name' => 'required',
            'status'=>'required|boolean'
        ]);
        Brand::create(['brand_name'=>$request->brand_name,'status'=>$request->status]);
        return redirect()->route('admin.brand.index')->with('success', 'Brand Added');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Brand $brand)
    {
        return view('backend.brand.edit', compact('brand'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Brand $brand)
    {
        $this->validate($request, [
            'brand_name' => 'required',
        ]);
        $brand->update(['brand_name'=>$request->brand_name,'status'=>$request->status]);
        return redirect()->route('admin.brand.index')->with('success', 'Brand Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Brand $brand)
    {
        try {
            $brand->forceDelete();
            return redirect()->route('admin.brand.index')->with('success', 'Brand Deleted');
        } catch (\Illuminate\Database\QueryException $e) {
            if ($e->getCode() == "23000") { //23000 is sql code for integrity constraint violation
                return redirect()->route('admin.brand.index')->with('error', 'Cannot delete brand because product exists with this brand, delete the product first then you can delete this brand');
            }
        }
    }
}
