<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;


class PermissionsController extends Controller
{

    function __construct()
    {
        $this->middleware('permission:permission-list');
        $this->middleware('permission:permission-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:permission-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:permission-delete', ['only' => ['destroy']]);
    }
    public function index()
    {
        $data = Permission::all();
        return view('backend.user-mgmt.permission.index')->with('data', $data);
    }

    public function store(Request $request)
    {
        $requestData = [
            'name'=>$request->name,
            'guard_name'=>'admin'
        ];
        $permission = Permission::create($requestData);
        return redirect()->back()->with('success', 'Permission Added');
    }


    public function edit($id)
    {
        $data = Permission::findorfail($id);
        return view('backend.user-mgmt.permission.edit')->with('data', $data);
    }


    public function update(Request $request, $id)
    {
        $requestData = $request->all();
        $permission = Permission::findOrFail($id);
        $permission->update($requestData);
        return redirect()->route('admin.permissions')->with('success', 'Permission Updated');
    }

    public function destroy(Request $request)
    {

        $data = Permission::findOrFail($request->id)->delete();
        return response()->json();
    }
}
