<?php

namespace App\Http\Controllers\Front;

use App\Model\Category;
use App\Model\Product;
use App\Model\Slider;
use Illuminate\Http\Request;

class HomeController extends BaseController
{
    public function index(Request $request){
        $data['sliders'] = Slider::active()->get();
        $data['categories'] = Category::where('parent_id',0)->get();
        $data['featured_products'] = Product::featured()->get();
        $data['fresh_products'] = Product::isfresh()->get();
        $data['new_products'] = Product::latest()->limit(6)->get();
        return view(parent::loadViewData('front.index'),compact('data'));
    }
}
