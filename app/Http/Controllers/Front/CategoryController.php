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
        $data['filter_data'] = $this->getFilterData();
        $data['price_range'] = $this->price_range();
        $data['sorting_params'] = json_encode($this->getSortingParams());
        $data['products'] = $data['category']->products()->get();

        return view(parent::loadViewData('front.category.show'),compact('data'));
    }


    public function getFilterData(){
        $data = [];
        if(request()->has('categories')){
            $data['checked_categories'] = explode(',',request()->get('categories'));
        }

        if(request()->has('price-range')){
            $data['price_range'] = explode(',',request()->get('price-range'));
        }
        return $data;
    }

    public function price_range(){
        if(request()->get('price-range')){
            $price_range =explode(',',request()->get('price-range'));
            if(count($price_range) == 2){
                $data['min']= $price_range[0];
                $data['max'] =$price_range[1];
                return $data;
            }else{
                $data = [];
                $data['min'] = "1";
                $data['max'] = request()->get('price-range');
                return $data;
            }
        }else{
            $data = [];
            $data['min'] = "1";
            $data['max'] = request()->get('price-range');
            return $data;
        }
    }

    protected function getSortingParams()
    {
        $data = [];

        if (request()->has('categories')) {
            $data['categories'] = request()->get('categories');
        }

        if (request()->has('price-range')) {
            $data['price_range'] = request()->get('price-range');
        }
        return $data;
    }
}
