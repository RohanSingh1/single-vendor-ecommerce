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

    public function search_now(Request $request){
        $query_data = $request->get('query');
        if ($request->ajax()){
            $data = Product::where('name','LIKE',"%$query_data%")->where('products.published',1)->get();
            $response['html'] = '<div class="lists_here"><ul class="dropdown-menu search_list" style="display:block;position:relative;width:529px;margin-top:36px;margin-left:1px;">';
            foreach($data as $search){
                $router = \URL::to('product',$search->slug);
                $response['html'] .= '<li><a href="'.$router.'" style="display: flex;font-size: 14px;padding: 2px 15px;text-decoration: none;font-weight: 400;color: black;"><div style="width: 50%;float:left;">
                <span class="p-title"> '.ucwords(str_replace('-', ' ', $search->slug)).ucwords(str_replace('-', ' ',isset($cats) ? '<span style="color: #ff6f61"> In ' .$cats->slug.'</span>' : '')).'</span><br></div><div style="/* float:right; */text-align: right;width: 50%;"><div><span class="">MRP  </span>
                <span class="">'.$search->price.'</span></div><div></div></div></a></li><div class="clearfix"></div>';
            }
            if(count($data) == 0){
                $response['html'] .= '<li style="display: flex;font-size: 14px;padding: 2px 15px;text-decoration: none;font-weight: 400;color: black;">No Product Found
                </li>';
            }
            $response['html'] .= '</ul></div>';
            return response()->json(json_encode($response));
        }else{
            $data = Product::where('name','LIKE',"%$query_data%")->where('products.published',1)->paginate(4);
                return view(parent::loadViewData('front.pages.search_result'),compact('data','query_data'));
            }

    }
}
