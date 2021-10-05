<?php

namespace App\Http\Controllers;

use App\helpers\SaveImage;
use App\User;
use App\Model\Product;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;

class CustomersController extends Controller
{
    public function index()
    {
        return view('backend.customers.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function apiCustomers()
    {
        $users = User::all();
        //dd($users);
        return Datatables::of($users)
        ->addColumn('image', function ($data) {
            if ($data->image !='') {
                return ' <a href="' . asset('storage/uploads/User/'.$data->image) . '"><img src="' . asset('storage/uploads/User/'.$data->image) . '" width="50px" ></a>';
            } else {
                return ' <a href="' . asset('no-image.jpg') . '" target="_blank"> <img src="' . asset('no-image.jpg') . '"  width="50px"></a>';
            }
        })
        ->addColumn('action', function ($user) {
            return '<a href="'.route("admin.customers.show",$user->id ).'" class="btn btn-xs btn-info " style="float:left; margin-right:5px" ><i class ="fa fa-eye"></i></a>
            <a href="customers/' . $user->id . '/edit" class="btn btn-xs btn-info " style="float:left; margin-right:5px" ><i class ="fa fa-edit"></i></a>
                <form action= "' . route('admin.customers.destroy', $user->id) . '" method="POST" accept-charset ="UTF-8" class="form-inline">
                    <input type="hidden" value="DELETE" name="_method">
                    <span class="input-group-btn">
                    <button class="btn btn-danger btn-xs delete-item" type="submit" value="delete"><i class ="fa fa-trash"></i></button>
                    </span>
                    <input type="hidden" value="' . csrf_token() . '" name="_token">
                    <input type="hidden" value="' .$user->id . '" name="id">
                </form>';
        })
        ->rawColumns(['image', 'action'])
        ->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.customers.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'name'=>'required',
            'email'=>'required|email|max:191',
            'phone_no'=>'nullable|max:10',
            'address_1'=>'required',
            'image'=>'nullable|image|max:1024',
            'status'=>'required|boolean',
        ]);

        if ($request->hasFile('image')) {
            $file_name = SaveImage::save($request->image, 'User');
        }

        User::create([
                'name'=>$request->name,
                'email'=>$request->email,
                'phone_no'=>$request->phone_no,
                'address_1'=>$request->address_1,
                'address_2'=>$request->address_2,
                'image'=>isset($file_name)?$file_name:null,
                'status'=>$request->status,
            ]);

        $request->session()->flash('success','Success The Customer Has Been Saved');
        return redirect()->route('admin.customers.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::findOrfail($id);
        return view('backend.customers.show',compact('customer'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request,$id)
    {
        if(!$customer = User::find($id)){
            $request->session()->flash('error','Sorry The Selected Customer Has Found Or Has Been Deleted');
            return redirect()->route('admin.customers.index');
        }
        return view('backend.customers.edit',compact('customer'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request,[
            'name'=>'required',
            'email'=>'required|email|max:191|unique:users,email,'.$id,
            'phone_no'=>'nullable|max:10',
            'address_1'=>'required',
            'image'=>'nullable|image|max:1024',
            'status'=>'required|boolean',
        ]);

        if(!$user = User::find($id)){
            $request->session()->flash('error','Sorry The Selected Customer Has Found Or Has Been Deleted');
            return redirect()->route('admin.customers.index');
        }

        if ($request->hasFile('image')) {
            $file_name = SaveImage::update($request->image, 'User', $user->image ? $user->imagePath : '');
            if($user->image != null && file_exists('storage/Uploads/User/'.$user->image)){
                unlink(base_path().'/public/storage/Uploads/User/'.$user->image);
            }
        } else {
            $file_name = $user->image;
        }

        $user->update([
            'name'=>$request->name,
            'email'=>$request->email,
            'phone_no'=>$request->phone_no,
            'address_1'=>$request->address_1,
            'address_2'=>$request->address_2,
            'image'=>isset($file_name)?$file_name:null,
            'status'=>$request->status,
        ]);

        $request->session()->flash('success','Success The Customer Has Been Update');
        return redirect()->route('admin.customers.index');
    }

    public function destroy(Request $request,$id)
    {
        if(!$user = User::find($request->id)){
            $request->session()->flash('error','Sorry The Selected Customer Has Found Or Has Been Deleted');
            return redirect()->route('admin.customers.index');
        }

        $user->delete();

        if($user->image != null && file_exists('storage/Uploads/User/'.$user->image)){
            unlink(base_path().'/public/storage/Uploads/User/'.$user->image);
        }

        $request->session()->flash('success','SuccessFully Deleted');
        return redirect()->route('admin.customers.index');
    }
}
