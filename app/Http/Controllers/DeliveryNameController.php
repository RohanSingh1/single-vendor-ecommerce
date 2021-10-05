<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\DeliveryName;
use Yajra\Datatables\Datatables;

class DeliveryNameController extends Controller
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
        return view('backend.delivery_name.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function apidelivery_name()
    {
        $delivery_name = DeliveryName::all();
        return Datatables::of($delivery_name)
            ->addColumn('action', function ($delivery_name) {
                return '<a href="delivery_name/' . $delivery_name->id . '/edit" class="btn btn-xs btn-info " style="float:left; margin-right:5px" ><i class ="fa fa-edit"></i></a>
                <form action= "' . route('admin.delivery_name.destroy', $delivery_name->id) . '" method="POST" accept-charset ="UTF-8" class="form-inline">
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
            'delivery_name' => 'required',
            'status'=>'required|boolean'
        ]);
        DeliveryName::create([
            'delivery_name'=>$request->delivery_name,
            'step'=>$request->step,
            'status'=>$request->status
        ]);
        return redirect()->route('admin.delivery_name.index')->with('success', 'Delivery Name Added');
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
    public function edit(DeliveryName $delivery_name)
    {
        return view('backend.delivery_name.edit', compact('delivery_name'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, DeliveryName $delivery_name)
    {
        $this->validate($request, [
            'delivery_name' => 'required',
        ]);
        $delivery_name->update([
            'delivery_name'=>$request->delivery_name,
            'step'=>$request->step,
            'status'=>$request->status
        ]);
        return redirect()->route('admin.delivery_name.index')->with('success', 'delivery_name Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(DeliveryName $delivery_name)
    {
        try {
            $delivery_name->forceDelete();
            return redirect()->route('admin.delivery_name.index')->with('success', 'delivery_name Deleted');
        } catch (\Illuminate\Database\QueryException $e) {
            if ($e->getCode() == "23000") { //23000 is sql code for integrity constraint violation
                return redirect()->route('admin.delivery_name.index')->with('error', 'Sorry The Selected Data Has Found Or Has Been Deleted');
            }
        }
    }
}
