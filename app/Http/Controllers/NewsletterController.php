<?php

namespace App\Http\Controllers;

use App\Model\NewsLetter;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class NewsletterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('backend.newsletters.index');
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
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email|max:255|unique:newsletters'
        ]);
        NewsLetter::create([
            'email' => $request->email
        ]);
        $message = 'Thank you for subscribing to our news letter.';
        return redirect()->route('thank-you')->with('success', $message); 
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Model\NewsLetter $newsLetter
     * @return \Illuminate\Http\Response
     */
    public function show(NewsLetter $newsLetter)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Model\NewsLetter $newsLetter
     * @return \Illuminate\Http\Response
     */
    public function edit(NewsLetter $newsLetter)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Model\NewsLetter $newsLetter
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, NewsLetter $newsLetter)
    {
        //
    }

    public function datatable()
    {
        $data = NewsLetter::get();
        return DataTables::of($data)
            ->editColumn('created_at', function ($data) {
                return $data->created_at!=''?$data->created_at->format('Y-m-d H:i'):'';
            })
            ->editColumn('is_subscribed', function ($data) {
                return active_column_check($data->is_subscribed);
            })
            ->rawColumns(['is_subscribed'])
            ->make(true);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Model\NewsLetter $newsLetter
     * @return \Illuminate\Http\Response
     */
    public function destroy(NewsLetter $newsLetter)
    {
        //
    }
}
