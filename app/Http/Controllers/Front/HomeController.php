<?php

namespace App\Http\Controllers\Front;

use App\ContactUs;
use App\Model\Category;
use App\Model\Coupon;
use App\Model\Deal;
use App\Model\Faq;
use App\Model\NewsLetter;
use App\Model\Page;
use App\Model\Product;
use App\Model\Setting;
use App\Model\Slider;
use Carbon\Carbon;
use Illuminate\Http\Request;

class HomeController extends BaseController
{
    public function index(Request $request){
        $data['sliders'] = Slider::active()->get();
        $data['featured_products'] = Product::featured()->get();
        $data['fresh_products'] = Product::Isfresh()->get();
        $data['new_products'] = Product::published()->latest()->limit(9)->get();
        $data['deals'] = Deal::where('status',1)->where('expiry_date','>',date('Y-m-d'))->get();
        $data['coupons'] = Coupon::where('status',1)->where('expiry_date','>',date('Y-m-d'))->get();
        $data['settings'] = Setting::select('id','text')->whereIn('slug',['front_title1','front_title2','front_title3'])->get();
        return view(parent::loadViewData('front.index'),compact('data'));
    }

    public function product_show(Request $request,$slug){
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

    public function faq(){
        $faqs = Faq::where('status',1)->get();
        return view(parent::loadViewData('front.pages.faq'),compact('faqs'));
    }

    public function offers(){
        $offers = Deal::where('status',1)->get();
        return view(parent::loadViewData('front.pages.offers'),compact('offers'));
    }

    public function contact_us(){
        return view(parent::loadViewData('front.pages.contact-us'));
    }

    public function storeContactUs(Request $request){
        $this->validate($request,[
            'name'=>'required|string|max:255',
            'email'=>'required|email|max:255',
            'phoneNo'=>'required|numeric|digits:10',
            'message'=>'required|string|max:25555',
            'address'=>'required',
         ]);

         ContactUs::create([
             'name' => $request->name,
             'email'=>$request->email,
             'phoneNo'=>$request->phoneNo,
             'address'=>$request->address,
             'subject'=>$request->subject,
             'message'=>$request->message,
            ]);

         return redirect()->back()->with('success','Thank you for your interest!');
    }

    public function coupon_products(Request $request,$related_products){
        $related_products = Coupon::where(['slug'=>$related_products,'status'=>1])->where('expiry_date','>',date('Y-m-d'))->first();
        $products = $related_products->products;
        return view(parent::loadViewData('front.pages.related_products'),compact('related_products','products'));
    }

    public function deal_products(Request $request,$related_products){
        $related_products = Deal::where(['slug'=>$related_products,'status'=>1])->where('expiry_date','>',date('Y-m-d'))->first();
        $products = $related_products->products;
        return view(parent::loadViewData('front.pages.related_products'),compact('related_products','products'));
    }

    public function show_all(Request $request,$related_products){
        $products = Product::where(function($query) use ($related_products){
            if($related_products == 'is_featured'){
                $query->where('is_featured',1);
            }elseif ('is_fresh') {
                $query->where('is_fresh',1);
            }
        })->published()->latest()->get();
        return view(parent::loadViewData('front.pages.related_products'),compact('products'));
    }

    public function show($slug)
    {
        $page = Page::whereSlug($slug)
            ->where('created_at', '<=', Carbon::now())
            ->published()
            ->firstOrFail();
        return view(parent::loadViewData('front.pages.index'),compact('page'));
    }
}
