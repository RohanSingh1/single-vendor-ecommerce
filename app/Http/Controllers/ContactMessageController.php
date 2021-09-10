<?php

namespace App\Http\Controllers;

use App\ContactUs;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;

class ContactMessageController extends Controller
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
        return view('backend.contact_message.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function apicontact_messages()
    {
        $contact_message = ContactUs::all();
        return Datatables::of($contact_message)
            ->addColumn('action', function ($contact_message) {
                return '<a href="contact_messages/' . $contact_message->id . '" class="btn btn-xs btn-info " style="float:left; margin-right:5px" ><i class ="fa fa-eye"></i></a>
                <form action= "' . route('admin.destroy_contact_messages') . '" method="POST" accept-charset ="UTF-8" class="form-inline">
                    <input type="hidden" name="id" value="'.$contact_message->id.'">
                    <span class="input-group-btn">
                    <button class="btn btn-danger btn-xs delete-item" type="submit" value="delete"><i class ="fa fa-trash"></i></button>
                    </span>
                    <input type="hidden" value="' . csrf_token() . '" name="_token">
                </form>';
            })
            ->make(true);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = ContactUs::findOrfail($id);
        return view('backend.contact_message.show',compact('data'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $data = ContactUs::findOrfail($request->id);
        $data->delete();
        return redirect()->route('thank-you')->with('success', 'Contact Deleted');

    }
}
