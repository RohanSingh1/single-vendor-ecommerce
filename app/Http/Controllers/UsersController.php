<?php

namespace App\Http\Controllers;

use App\helpers\SaveImage;
use App\Model\Admin\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Support\Facades\Hash;
use Validator;
use Response;
use Illuminate\Support\Facades\Input;
use Illuminate\Foundation\Auth\RegistersUsers;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Yajra\Datatables\Datatables;

class UsersController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('permission:user-list');
        $this->middleware('permission:user-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:user-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:user-delete', ['only' => ['destroy']]);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $data = Admin::where('id','!=','1')->get();
        return view('backend.users.index')->withData($data);
    }
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
        $user1['name'] = $request->name;
        $user1['email'] = $request->email;
        $user1['password'] = Hash::make($request->password);
        $user1['is_super'] = 0;
        if ($request->hasFile('image')) {
            $file_name = SaveImage::save($request->image, 'Users');
        }
        $data = Admin::create(array_merge($user1,['image'=>$file_name]));
        return redirect()->back()->with('success', 'User Added');
    }
    public function assign_role($id)
    {

        $data['user'] = Admin::findOrFail($id);
        $active_role_permission = $data['user']->roles->all();

        //dd($active_role_permission);
        $u_prem = array();
        foreach ($active_role_permission as $val) {
            $u_prem[] = $val->id;
        }
        $data['active_role_permission'] = $u_prem;
        $data['roles'] = Role::all();

        return view('backend.users.assign-role', $data);
    }
    public function assignRoleShow(Request $request)
    {
        //
        $roles = \DB::table('model_has_roles as rp')
            ->join('roles as r', 'r.id', 'rp.role_id')->where('rp.model_id', $request->id)->get();

        $data = array();
        foreach ($roles as $val) {
            $data[] = "<li class='list-group-item'>" . $val->name . "</li>";
        }
        if (!empty($data)) {
            $return = $data;
        } else {
            $return = "<li class='list-group-item'>No Role has been assigned.</li>";
        }


        return $return;
    }
    public function assign_role_store(Request $request)
    {
        //        dd($request->all());
        $user = Admin::findOrFail($request->user_id);
        \DB::table('model_has_roles')->where('model_id', $user->id)->delete();
        if (!empty($request->selected_permission)) {
            foreach ($request->selected_permission as $value) {
                $r = \DB::table('model_has_roles')->where('model_id', $user->id)->delete();

                //$role = Role::where('id',$value)->firstOrFail();
                $user->assignRole($request->input('selected_permission'));
            }
        }
        // $flashMessage = [
        //     'heading'=>'success',
        //     'type'=>'success',
        //     'message'=>'Permission assigned successfully.'
        // ];
        // \Session::flash('flash_message', $flashMessage);
        $message = "Role updated successfully to User";
        if (isset($request->assign)) {
            return redirect()->back()->with('success', $message);
        } else {
            return redirect()->route('admin.users')->with('success', $message);
        }
    }
    public function edit($id)
    {
        $data = Admin::findOrFail($id);
        return view('backend.users.edit', compact('data'));
    }
    public function update(request $request)
    {
        $this->validate($request, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255'],
        ]);
        $data = Admin::findOrFail($request->id);
        $data->name = $request->first_name;
        if ($request->password) {
            $data->password = Hash::make($request->password);
        }
        //$data->email = $request->email;
        $data->save();
        return redirect()->back()->with('success', 'User Information Updated');
    }

    public function destroy(Request $request)
    {
        $user = Admin::find($request->id)->delete();
        return response()->json();
    }
}
