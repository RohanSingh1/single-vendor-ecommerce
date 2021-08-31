<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Model\Category;
use App\Model\Product;
use View;
use Cart;

class BaseController extends Controller
{

    protected function loadViewData($path){
        View::composer('*',function ($view){
            $view->with('cart',$this->cartItems());
            $view->with('cart_total',Cart::getTotal());
            $view->with('cart_total_qty',Cart::getContent()->count());
            $view->with('categories', Category::where('parent_id',0)->get());
            $view->with('images_path',asset('storage/Uploads/'));
            $view->with('images',asset('storage/Uploads/'));
            $view->with('current_route',$route = \Route::currentRouteName());
        });
        return $path;
    }

    protected function cartItems()
    {
        $data = [];
        foreach (Cart::getContent() as $key => $item) {
            $data[$key] = $item;
            $data[$key]->product = Product::find($item->id);
        }
        return $data;
    }

}

