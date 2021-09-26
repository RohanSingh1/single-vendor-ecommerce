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
        $locations = Location::all();
        return Datatables::of($locations)
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
            'from_location' => 'required',
            'to_location' => 'required',
            'price' => 'required|numeric',
            'status' => 'required|boolean',
        ]);
        Location::create([
            'from_location'=>$request->from_location,
            'to_location'=>$request->to_location,
            'price'=>$request->price,
            'status'=>$request->status
        ]);
        return redirect()->route('admin.locations.index')->with('success', 'Delivery Name Added');
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
            'from_location' => 'required',
            'to_location' => 'required',
            'price' => 'required|numeric',
            'status' => 'required|boolean',
        ]);
        $location->update([
            'from_location'=>$request->from_location,
            'to_location'=>$request->to_location,
            'price'=>$request->price,
            'status'=>$request->status
        ]);
        return redirect()->route('admin.locations.index')->with('success', 'location Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Location $locations)
    {
        try {
            $locations->forceDelete();
            return redirect()->route('admin.locations.index')->with('success', 'locations Deleted');
        } catch (\Illuminate\Database\QueryException $e) {
            if ($e->getCode() == "23000") { //23000 is sql code for integrity constraint violation
                return redirect()->route('admin.locations.index')->with('error', 'Cannot delete locations because product exists with this locations, delete the product first then you can delete this locations');
            }
        }
    }
}
