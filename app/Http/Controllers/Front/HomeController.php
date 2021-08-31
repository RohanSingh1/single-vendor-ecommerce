<?php

namespace App\Http\Controllers\Front;

use App\Model\Category;
use App\Model\NewsLetter;
use App\Model\Product;
use App\Model\Slider;
use Illuminate\Http\Request;

class HomeController extends BaseController
{
    public function index(Request $request){
        $data['sliders'] = Slider::active()->get();
        $data['featured_products'] = Product::featured()->get();
        $data['fresh_products'] = Product::Isfresh()->get();
        $data['new_products'] = Product::latest()->limit(9)->get();

        return view(parent::loadViewData('front.index'),compact('data'));
    }

    public function show(Request $request,$slug){
        if (!$product = Product::where('slug', $slug)->first()) {
            $request->session()->flash('success','Sorry Product Not Found');
           return redirect()->route('index');
       }
       $front_info1 = \App\Model\Setting::select('id', 'text')->where('slug', 'front_info1')->first()['text'];
       $front_info2 = \App\Model\Setting::select('id', 'text')->where('slug', 'front_info2')->first()['text'];
       $categories = $product->categories()->get()->pluck('id')->toArray();
       $featured_products = Product::featured()->get();
       $related_products = Product::whereHas('categories', function ($query) use ($categories) {
                        $query->whereIn('category.id', $categories);
                    })->whereNotIn('name', [$product->name])->take(10)->get();

       return view(parent::loadViewData('front.detail'),compact('product','front_info1','front_info2','related_products','featured_products'));

    }

    public function newsletter(Request $request){
        $this->validate($request, [
            'email' => 'required|email|max:255|unique:newsletters'
        ]);
        NewsLetter::create([
            'email' => $request->email
        ]);
        $request->session()->flash('success','Thank you for subscribing to our News Letter');
        return redirect()->route('index');
    }
}
