<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Province;
use Yajra\Datatables\Datatables;

class ProvinceController extends Controller
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
        return view('backend.provinces.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function apiProvinces()
    {
        $provinces = Province::orderBy('id', 'DESC')->get();
        return Datatables::of($provinces)
            ->addColumn('action', function ($provinces) {
                return '<a href="provinces/' . $provinces->id . '/edit" class="btn btn-xs btn-info " style="float:left; margin-right:5px" ><i class ="fa fa-edit"></i></a>
                <form action= "' . route('admin.provinces.destroy', $provinces->id) . '" method="POST" accept-charset ="UTF-8" class="form-inline">
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
            'name' => 'required',
            'status'=>'required|boolean'
        ]);
        Province::create([
            'name'=>$request->name,
            'status'=>$request->status
        ]);
        return redirect()->route('admin.provinces.index')->with('success', 'Province Added');
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
    public function edit(Province $province)
    {
        return view('backend.provinces.edit', compact('province'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Province $province)
    {
        $this->validate($request, [
            'name' => 'required',
            'status'=>'required|boolean'
        ]);
        $province->update([
            'name'=>$request->name,
            'status'=>$request->status
        ]);
        return redirect()->route('admin.provinces.index')->with('success', 'Provinces Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,$id)
    {
        if(!$province = province::find($id)){
            $request->session()->flash('error','Sorry The Selected province Has Found Or Has Been Deleted');
            return redirect()->route('admin.provinces.index');
        }
        $province->delete();
        $request->session()->flash('success','SuccessFully Deleted');
        return redirect()->route('admin.provinces.index');
    }
}
