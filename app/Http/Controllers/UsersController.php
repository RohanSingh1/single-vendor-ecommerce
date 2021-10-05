<?php

namespace App\Http\Controllers;

use App\helpers\SaveImage;
use App\Model\Admin\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Yajra\Datatables\Datatables;

class UsersController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function apiUser()
    {
        $users = Admin::where('id','!=','1')->where('is_admin','!=',1)->get();
        //dd($users);
        return Datatables::of($users)
        ->addColumn('image', function ($data) {
            if ($data->image !='') {
                return ' <a href="' . asset('storage/Uploads/Users/'.$data->image) . '"><img src="' . asset('storage/Uploads/Users/'.$data->image) . '" width="50px" ></a>';
            } else {
                return ' <a href="' . asset('no-image.jpg') . '" target="_blank"> <img src="' . asset('no-image.jpg') . '"  width="50px"></a>';
            }
        })
        ->addColumn('action', function ($deal) {
            return '<a href="'.route('admin.users.edit', $deal->id).'" class="btn btn-xs btn-info " style="float:left; margin-right:5px" ><i class ="fa fa-edit"></i></a>
                <form action= "' . route('admin.users.destroy', $deal->id) . '" method="POST" accept-charset ="UTF-8" class="form-inline">
                    <input type="hidden" value="DELETE" name="_method">
                    <span class="input-group-btn">
                    <button class="btn btn-danger btn-xs delete-item" type="submit" value="delete"><i class ="fa fa-trash"></i></button>
                    </span>
                    <input type="hidden" value="' . csrf_token() . '" name="_token">
                    <input type="hidden" value="' .$deal->id . '" name="id">
                </form>';
        })
        ->rawColumns(['image', 'action'])
        ->make(true);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('backend.users.index');
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
            'address'=>$request->address,
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
        if ($request->hasFile('image')) {
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
            'address'=>$request->address,
            'is_admin'=>$request->is_admin,
            'status'=>$request->status
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
