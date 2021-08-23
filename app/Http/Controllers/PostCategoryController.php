<?php

namespace App\Http\Controllers;

use App\Model\PostCategory;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class PostCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('backend.post-category.index');
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
     * @param \App\Model\PostCategory $postCategory
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function show(PostCategory $postCategory)
    {
        return view('backend.post-category.show', compact('postCategory'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Model\PostCategory $postCategory
     * @return \Illuminate\Http\Response
     */
    public function edit(PostCategory $postCategory)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Model\PostCategory $postCategory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PostCategory $postCategory)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Model\PostCategory $postCategory
     * @return \Illuminate\Http\Response
     */
    public function destroy(PostCategory $postCategory)
    {
        //
    }

    public function apiDataTable(Request $request)
    {
        $data = PostCategory::get();
        return DataTables::of($data)
            ->addColumn('action', function ($data) use ($request) {
                return showAction($data->id, 'admin.post-category');
            })
            ->rawColumns(['action'])
            ->make(true);
    }
}
