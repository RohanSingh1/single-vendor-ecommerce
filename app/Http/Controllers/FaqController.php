<?php

namespace App\Http\Controllers;

use App\helpers\SaveImage;
use Illuminate\Http\Request;
use App\Model\Faq;
use Yajra\Datatables\Datatables;

class FaqController extends Controller
{

    public function index()
    {
        return view('backend.faq.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function apiFaq()
    {
        $faq = Faq::all();
        //dd($faq);
        return Datatables::of($faq)
            ->addColumn('action', function ($faq) {
                return '
           <a href="faq/' . $faq->id . '/edit" class="btn btn-xs btn-info " style="float:left; margin-right:5px" ><i class ="fa fa-edit"></i></a>
            <form action= "' . route('admin.faq.destroy', $faq->id) . '" method="POST" accept-charset ="UTF-8" class="form-inline">
                <input type="hidden" value="DELETE" name="_method">
                <span class="input-group-btn">
                <button class="btn btn-danger btn-xs delete-item" type="submit" value="delete"><i class ="fa fa-trash"></i></button>
                </span>
                <input type="hidden" value="' . csrf_token() . '" name="_token">
            </form>
           ';
            })
            ->rawColumns(['action'])
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
            'title' => 'required|unique:faq,title',
            'status'=>'required|boolean'
        ]);

        Faq::create([
            'title'=>ucfirst($request->title),
            'slug'=>str_slug($request->title),
            'description'=>$request->description,
            'status'=>$request->status,
        ]);
        return redirect()->route('admin.faq.index')->with('success', 'faq Added');
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
    public function edit(Faq $faq)
    {
        return view('backend.faq.edit', compact('faq'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Faq $faq)
    {
        $this->validate($request, [
            'title' => 'required|unique:faq,title,'.$faq->id,
            'status'=>'required|boolean'
        ]);


        $faq->update([
            'title'=>ucfirst($request->title),
            'slug'=>str_slug($request->title),
            'description'=>$request->description,
            'status'=>$request->status,
        ]);
        return redirect()->route('admin.faq.index')->with('success', 'Faq Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Faq $faq)
    {
        try {
            $faq->forceDelete();
            return redirect()->route('admin.faq.index')->with('success', 'Faq Deleted');
        } catch (\Illuminate\Database\QueryException $e) {
            if ($e->getCode() == "23000") { //23000 is sql code for integrity constraint violation
                return redirect()->route('admin.faq.index')->with('error', 'Cannot delete Faq because product exists with this faq, delete the product first then you can delete this faq');
            }
        }
    }
}
