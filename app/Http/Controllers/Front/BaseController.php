<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use View;

class BaseController extends Controller
{

    protected function loadViewData($path){
        View::composer('*',function ($view){
            $view->with('images_path',asset('storage/Uploads/'));
            $view->with('images',asset('storage/Uploads/'));
            $view->with('current_route',$route = \Route::currentRouteName());
        });
        return $path;
    }

}

