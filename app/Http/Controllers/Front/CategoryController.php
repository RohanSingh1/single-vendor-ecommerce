<?php

namespace App\Http\Controllers\Front;

use App\Model\Category;
use Illuminate\Http\Request;

class CategoryController extends BaseController
{
    public function index()
    {
        $data['categories'] = Category::published()->get();
        return view(parent::loadViewData('front.category.index'),$data);
    }

    public function show($slug,Request $request)
    {
        $data['category']=Category::whereSlug($slug)
            ->published()
            ->withCount('products')
            ->firstOrFail();

            $data['products'] = $data['category']->products()->get();

        return view(parent::loadViewData('front.category.show'),compact('data'));
    }
}
