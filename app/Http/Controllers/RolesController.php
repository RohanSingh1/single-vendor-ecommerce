<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Model\RoleHasPermission;

class RolesController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:role-list');
        $this->middleware('permission:role-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:role-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:role-delete', ['only' => ['destroy']]);
    }
    public function index()
    {
        $data = Role::where('id','!=','1')->get();
        $permission = Permission::all();
        return view('backend.user-mgmt.roles.index')->with('data', $data)->with('permission', $permission);
    }


    public function create()
    {
        //
    }


    public function store(Request $request)
    {
        //
        $this->validate($request, [
            'name' => 'required|unique:roles,name',
            'permission' => 'required',
        ]);
        $role = Role::create(['name' => $request->input('name')]);
        $role->syncPermissions($request->input('permission'));
        return redirect()->back()->with('success', 'Role Created Successfully');
    }


    public function show(Request $request)
    {
        //
        $permissions = \DB::table('role_has_permissions as rp')
            ->join('permissions as p', 'p.id', 'rp.permission_id')->where('rp.role_id', $request->id)->get();

        $data = array();
        foreach ($permissions as $val) {
            $data[] = "<li class='list-group-item'>" . $val->name . "</li>";
        }
        if (!empty($data)) {
            $return = $data;
        } else {
            $return = "<li class='list-group-item'>No permission has been assigned.</li>";
        }


        return $return;
    }


    public function assign_permission_store(Request $request)
    {
        RoleHasPermission::where('role_id', $request->role_id)->delete();
        $role = Role::where('id', $request->role_id)->firstOrFail();
        //dd($role);
        $role->name = $request->role_name;
        $role->update();

        if (!empty($request->selected_permission)) {
            foreach ($request->selected_permission as $value) {
                $permission = Permission::where('id', $value)->firstOrFail();
                $pu = new RoleHasPermission();
                $pu->role_id = $request->role_id;
                $pu->permission_id = $permission->id;
                $pu->save();
            }
        }
        if (isset($request->assign)) {
            return redirect()->back()->with('success', 'Permission Updated successfully to role');
        } else {
            return redirect()->route('admin.roles.index')->with('success', 'Permission Updated successfully to role');
        }
    }
    public function edit($id)
    {

        $data['role'] = Role::findorfail($id);

        $active_role_permission = \DB::table('role_has_permissions')->where('role_id', $data['role']->id)->get();
        $u_prem = array();
        foreach ($active_role_permission as $val) {
            $u_prem[] = $val->permission_id;
        }
        $data['active_role_permission'] = $u_prem;
        $data['permissions'] = Permission::all();
        //dd($data['active_role_permission']);
        return view('backend.user-mgmt.roles.edit', $data);
    }


    public function update(Request $request, $id)
    {
        //
    }

    public function destroy(Request $request)
    {
        $user = Role::find($request->id)->delete();
        return response()->json();
    }
}
