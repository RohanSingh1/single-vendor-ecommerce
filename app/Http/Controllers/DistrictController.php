<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\District;
use Yajra\Datatables\Datatables;

class DistrictController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
         $this->middleware(['auth:admin']);
    }
    public function index()
    {
        return view('backend.districts.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function apiDistricts()
    {
        $district = District::orderBy('id', 'DESC')->get();
        return Datatables::of($district)
            ->addColumn('provinces', function ($district) {
                return isset($district->province) && $district->province !='' ? $district->province->name : 'Not Found';
            })
            ->addColumn('action', function ($district) {
                return '<a href="' . route('admin.districts.edit', $district->id) . '" class="btn btn-xs btn-info " style="float:left; margin-right:5px" ><i class ="fa fa-edit"></i></a>
                <form action= "' . route('admin.districts.destroy', $district->id) . '" method="POST" accept-charset ="UTF-8" class="form-inline">
                    <input type="hidden" value="DELETE" name="_method">
                    <span class="input-group-btn">
                    <button class="btn btn-danger btn-xs delete-item" type="submit" value="delete"><i class ="fa fa-trash"></i></button>
                    </span>
                    <input type="hidden" value="' . csrf_token() . '" name="_token">
                </form>';
            })
            ->rawColumns(['provinces', 'action'])
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
            'name'=>'required',
            'province_id'=>'required|exists:provinces,id',
            'status' => 'required|boolean',
        ]);
        District::create([
            'name'=>$request->name,
            'slug'=>str_slug($request->name),
            'province_id'=>$request->province_id,
            'status'=>$request->status
        ]);
        return redirect()->route('admin.districts.index')->with('success', 'Delivery Name Added');
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
    public function edit(District $district)
    {
        return view('backend.districts.edit', compact('district'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, District $district)
    {
        $this->validate($request, [
            'name'=>'required',
            'province_id'=>'required|exists:provinces,id',
            'status' => 'required|boolean',
        ]);
        $district->update([
            'name'=>$request->name,
            'slug'=>str_slug($request->name),
            'province_id'=>$request->province_id,
            'status'=>$request->status
        ]);
        return redirect()->route('admin.districts.index')->with('success', 'district Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,$id)
    {
        if(!$district = District::find($id)){
            $request->session()->flash('error','Sorry The Selected District Has Found Or Has Been Deleted');
            return redirect()->route('admin.districts.index');
        }
        $district->delete();
        $request->session()->flash('success','SuccessFully Deleted');
        return redirect()->route('admin.districts.index');
    }
}
