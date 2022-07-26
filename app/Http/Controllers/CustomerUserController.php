<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class CustomerUserController extends Controller
{
    public function apiCustomerUsers()
    {
        $data = User::where('password', '!=', ' ')->get();
        //dd($data);
        return DataTables::of($data)
            ->addColumn('action', function ($data) {
                return '
                 <a href="customer-users/' . $data->id . '" class="btn btn-xs btn-info " style="float:left; margin-right:5px" ><i class ="fa fa-eye"></i></a>
           ';
            })
            ->editColumn('name', function ($data) {
                return $data->fullName;
            })
            ->editColumn('created_at', function ($data) {
                return $data->created_at->format('Y-m-d h:m A');
            })
            ->make(true);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('backend.customer-user.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
