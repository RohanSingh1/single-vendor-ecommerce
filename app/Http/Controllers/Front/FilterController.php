<?php

namespace App\Http\Controllers\Front;

use App\Model\Product;
use Illuminate\Http\Request;

class FilterController extends BaseController
{
    public function product_filter(Request $request){
        $data = [];
        if($request->has('sort-by')){
            switch (request()->get('sort-by')) {
                case 'latest':
                    $sort = 'products.created_at';
                    $sorting = 'desc';
                    break;
                    case 'price-high':
                    $sort ='products.price';
                    $sorting = 'desc';
                    break;
                    case 'price-low':
                    $sort = 'products.price';
                    $sorting = 'asc';
                    break;
                    default:
                    $sort ='products.id';
                $sorting = 'asc';
            }
        }else{
            $sort ='products.id';
            $sorting = 'asc';
        }
        $data['filter_data'] = $this->getFilterData();
        $data['price_range'] = $this->price_range();
        $data['sorting_params'] = json_encode($this->getSortingParams());
            $data['products'] = Product::join( 'category_product', 'category_id', '=', 'product_id')
            ->whereHas('categories', function($q) use($request) {
                if($request->has('categories')){
                    $q->where('slug', $request->categories);
                }
            })
        ->where(function ($query) use ($data,$request) {
            if ($request->has('price-range')){
                if($data['price_range']['max'] == "1000"){
                $query->where('price','>',"1000");
                }else{
                    $query->whereBetween('price',[$data['price_range']['min'],$data['price_range']['max']]);
                }
            }
        })
        ->orderBy($sort,$sorting)
        ->paginate(5);
        return view(parent::loadViewData('front.pages.filter'),compact('data'));
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
            $price_range =explode('-',request()->get('price-range'));
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
