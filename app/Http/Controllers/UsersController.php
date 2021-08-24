<?php

namespace App\Http\Controllers;

use App\helpers\SaveImage;
use App\Model\Admin\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Spatie\Permission\Models\Role;

class UsersController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $data = Admin::where('id','!=','1')->where('is_admin','!=',1)->get();
        return view('backend.users.index')->withData($data);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:admins'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        if ($request->hasFile('image')) {
            $file_name = SaveImage::save($request->image, 'Users');
        }

        Admin::create([
            'name'=>$request->name,
            'email'=>$request->email,
            'password'=>Hash::make($request->password),
            'image'=>isset($file_name)?$file_name:null,
            'is_admin'=>$request->is_admin
        ]);

        return redirect()->back()->with('success', 'User Added');
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
        if ($data->image != null) {
            if(Storage::disk('public')->exists('uploads'.DIRECTORY_SEPARATOR.'Users' . DIRECTORY_SEPARATOR . $data->image)){
                Storage::disk('public')->delete('uploads'.DIRECTORY_SEPARATOR.'Users'. DIRECTORY_SEPARATOR . $data->image );
            }
                $file_name = SaveImage::save($request->image, 'Users');
            }
        $data->update([
            'name'=>$request->name,
            'email'=>$request->email,
            'password'=>$request->has('password') ? Hash::make($request->password): $data->password,
            'image'=>isset($file_name)?$file_name:$data->image,
            'is_admin'=>$request->is_admin
        ]);
        return redirect()->back()->with('success', 'User Information Updated');
    }

    public function destroy(Request $request)
    {
        $user = Admin::find($request->id);
        if($user->image !=null && Storage::disk('public')->exists('uploads'.DIRECTORY_SEPARATOR.'Users' . DIRECTORY_SEPARATOR . $user->image)){
            Storage::disk('public')->delete('uploads'.DIRECTORY_SEPARATOR.'Users'. DIRECTORY_SEPARATOR . $user->image );
        }
        $user->delete();
        return response()->json();
    }
}
