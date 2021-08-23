<?php

namespace App\Http\Controllers;

use App\helpers\CheckExistingSlug;
use App\helpers\SaveImage;
use App\Model\Color;
use App\Repositories\CategoryRepositoryInterface;
use Illuminate\Http\Request;
use App\Model\Category;
use Illuminate\Support\Facades\Cache;
use Yajra\Datatables\Datatables;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware(['auth:admin']);
        $this->middleware('permission:category-list');
        $this->middleware('permission:category-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:category-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:category-delete', ['only' => ['destroy']]);
    }

    public function index()
    {
        $category = Category::select('id', 'name', 'parent_id', 'order', 'published')
            ->parentOnly()
            ->with('childrenCategories', 'childrenCategories.children')
            ->orderBy('order')
            ->get();
//        dd($category);
        return view('backend.category.index', compact('category'));
    }

    private function requestStore($request)
    {
        $request->order ? $order = $request->order : $order = 1;
        $data = $this->commonData($request);
        $data['slug'] = CheckExistingSlug::check('App\Model\Category', $request->name);
        $data['order'] = $order;
        if ($request->hasFile('image')) {
            $data['image'] = SaveImage::save($request->image, 'category');
        }
        return $data;

    }

    private function requestUpdate($request, $model)
    {
        $data = $this->commonData($request);

        if ($request->hasFile('image')) {
            $data['image'] = SaveImage::update($request->image, 'category', $model->image ? $model->imagePath : '');
        } else {
            $data['image'] = $model->image;
        }
        return $data;
    }

    private function commonData($request)
    {
        $request->order ? $order = $request->order : $order = 1;
        $data['name'] = $request->name;
        $data['description'] = $request->description;
        $data['published'] = switch_case_check($request->published);
        $data['is_featured'] = switch_case_check($request->is_featured);
        $data['is_bestseller'] = switch_case_check($request->is_bestseller);
        $data['created_by'] = auth('admin')->user()->id;
        return $data;
    }


    public function create()
    {
        $colors = Color::get();
        return view('backend.category.create', compact('colors'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
        ]);
        $category = Category::create($this->requestStore($request));
        $category->colors()->attach($request->colors);
        $this->forgetCache();
        toast(__('global.data_saved'), 'success');
        return redirect()->route('admin.category.index')->with('success', 'Category Added');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function edit($id)
    {
        $category = category::find($id);
        $colors = Color::get();
        return view('backend.category.edit', compact('category', 'colors'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param Category $category
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Validation\ValidationException
     */
    public function update(Request $request, Category $category)
    {
        $this->validate($request, [
            'name' => 'required',
        ]);
        $category->colors()->sync($request->colors);
        $category->update($this->requestUpdate($request, $category));
        $this->forgetCache();
        toast(__('global.data_update'), 'success');
        return redirect()->route('admin.category.index')->with('success', 'Category Updated');
    }

    private function forgetCache()
    {
        Cache::forget('category-menu');
        Cache::forget('top-menu');
        Cache::forget('home-menu');
        Cache::forget('category-parent');
    }


    public function saveOrder(Request $request)
    {
        $this->forgetCache();
        $dataCount = 1;
        $childCount = 1;
        $subfieldCount = 1;
        foreach ($request->data as $data) {
            foreach ($data['children'] ?? [] as $child) {
                foreach ($child['children'] ?? [] as $subchild) {
                    $menus = Category::find($subchild['id']);
                    $menus->parent_id = $child['id'];
                    $menus->order = $subfieldCount;
                    $menus->save();
                    $subfieldCount++;
                }
                $menuChildren = Category::find($child['id']);
                $menuChildren->parent_id = $data['id'];
                $menuChildren->order = $childCount;
                $menuChildren->save();
                $childCount++;
            }
            $menu = Category::find($data['id']);
            $menu->parent_id = 0;
            $menu->order = $dataCount;
            $menu->save();
            $dataCount++;
        }
        toast(__('global.data_saved'), 'success');
        return 200;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        if (count($category->children) > 0) {
            return 23000;
        }
        $category->delete();
        $this->forgetCache();
        return 204;

    }
}
