<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Location;
use Yajra\Datatables\Datatables;

class LocationController extends Controller
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
        return view('backend.locations.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function apilocations()
    {
        $locations = Location::orderBy('id', 'DESC')->get();
        return Datatables::of($locations)
        ->addColumn('provinces', function ($locations) {
            return isset($locations->province) && $locations->province !=''?$locations->province->name:'Not Found';
        })
        ->addColumn('districts', function ($locations) {
            return isset($locations->district) && $locations->district !=''?$locations->district->name:'Not Found';
        })
            ->addColumn('action', function ($locations) {
                return '<a href="' . route('admin.locations.edit', $locations->id) . '" class="btn btn-xs btn-info " style="float:left; margin-right:5px" ><i class ="fa fa-edit"></i></a>
                <form action= "' . route('admin.locations.destroy', $locations->id) . '" method="POST" accept-charset ="UTF-8" class="form-inline">
                    <input type="hidden" value="DELETE" name="_method">
                    <span class="input-group-btn">
                    <button class="btn btn-danger btn-xs delete-item" type="submit" value="delete"><i class ="fa fa-trash"></i></button>
                    </span>
                    <input type="hidden" value="' . csrf_token() . '" name="_token">
                </form>';
            })
            ->rawColumns(['provinces', 'districts','action'])
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
            'name' => 'required|unique:locations,name',
            'province_id'=>'required|exists:provinces,id',
            'district_id'=>'required|exists:districts,id',
            'price' => 'required|numeric',
            'status' => 'required|boolean',
        ]);
        Location::create([
            'name'=>$request->name,
            'slug'=>str_slug($request->name),
            'province_id'=>$request->province_id,
            'district_id'=>$request->district_id,
            'price'=>$request->price,
            'status'=>$request->status
        ]);
        return redirect()->route('admin.locations.index')->with('success', 'Location Added');
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
    public function edit(Location $location)
    {
        return view('backend.locations.edit', compact('location'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Location $location)
    {
        $this->validate($request, [
            'name' => 'required|unique:locations,name,'.$location->id,
            'province_id'=>'required|exists:provinces,id',
            'district_id'=>'required|exists:districts,id',
            'price' => 'required|numeric',
            'status' => 'required|boolean',
        ]);
        $location->update([
            'name'=>$request->name,
            'slug'=>str_slug($request->name),
            'province_id'=>$request->province_id,
            'district_id'=>$request->district_id,
            'price'=>$request->price,
            'status'=>$request->status
        ]);
        return redirect()->route('admin.locations.index')->with('success', 'Location Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,$id)
    {
        if(!$location = location::find($id)){
            $request->session()->flash('error','Sorry The Selected Location Has Found Or Has Been Deleted');
            return redirect()->route('admin.locations.index');
        }
        $location->delete();
        $request->session()->flash('success','SuccessFully Deleted');
        return redirect()->route('admin.locations.index');
    }
}
