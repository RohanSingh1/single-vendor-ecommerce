<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Model\Coupon;
use App\Model\Order;
use App\Model\Product;
use App\Model\Setting;
use App\Model\WishList;
use Illuminate\Http\Request;
use Cart;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{
         public function orders_store(Request $request){
            if(!isset(auth()->user()->address)){
                $request->session()->flash('message', 'Please Provide Shipping Address');
                return redirect()->back();
            }
            try {
                $carts = get_price_check_coupon();
           // Create new order
           $cdt = isset($carts['coupon_discount_total'])?$carts['coupon_discount_total']: 0;
           $cd = isset($carts['coupon_discount']) ?  $carts['coupon_discount'] : 0;

           $order = Order::create([
                'user_id' => auth()->user()->id,
                'full_names' => auth()->user()->f_name.' '.auth()->user()->l_name,
                'payment_option' => 'cash_on_delivery',
                'currency_type'=> \Session::has('currency') && \Session::get('currency') == 'usd' ? 'usd' : 'nrs',
                'shipping_price' => isset($carts['shipping'])?$carts['shipping']:0,
                'coupon_discounts' =>$cd,
                'coupon_discounts_total' => $cdt,
                'total_discounts' => $cdt,
                'sub_totals' => \Cart::getSubTotal(),
                'grand_totals' => $carts['total'],
                'status' => 'pending',
            ]);

            // Attach products
            $cartContents = \Cart::getContent();
            if ($cartContents) {


                foreach ($cartContents as $cartContent) {
                $order->products()->attach($cartContent->id,
                    [
                    'quantity' => $cartContent->quantity,
                    'price' => $cartContent->price,
                    'colors'=>$cartContent->attributes->colors !=''?$cartContent->attributes->colors:null,
                    'sizes'=>$cartContent->attributes->sizes != '' ? $cartContent->attributes->sizes: null,
                    ]
                );
                }
            }
            $request->session()->flash('message','Your Order Has Been Placed Successfully. We Will Contact You Soon');
            \Cart::clear();
            session_unset();
            return redirect()->route('index');
            return response()->json(json_encode($response));
            } catch (\Exception $exception) {
            \Log::alert('At Product Checkout '.$exception->getMessage());
            $request->session()->flash('message','Opps Something Went Wrong With Procceding To Checkout Please Contact System Administrator');
            return redirect()->route('index');
            }
            return redirect()->route('index');
        }

	public function removeCoupon(Request $request){
	    if($request->has('coupon_code') && $request->coupon_code !=''){
            if(isset($_COOKIE['coupon_code']) && !empty($_COOKIE['coupon_code'])){
                setcookie('coupon_code', "", time() - 1);
            }
	        $request->session()->flash('message','Success The Coupon Has Been Removed');
        }
	    return redirect()->back();
    }

    public function apply_coupon(Request $request){
        if(!$coupon = Coupon::where('coupon_code',$request->coupon_code)->first()){
            $request->session()->flash('message','Sorry Coupon Does Not Exists Or Has Been Removed');
            return redirect()->back();
        }

        if($coupon->expiry_date < date('Y-m-d')){
            $request->session()->flash('message','Sorry The Coupon Has Been Expired');
            return redirect()->back();
        }
        setcookie('coupon_code', $request->coupon_code, time()+360000);
        $request->session()->flash('message','Success Coupon Applied');
        return redirect()->back();
    }


        public function addToCart(Request $request){
            $response['error'] = true;
            $request->has('quantity') ? $quantity = $request->quantity : $quantity = 1;
            try{
                $product = Product::where('slug',$request->get('now_products')['slug'])->firstOrFail();

                if($carts = Cart::get($product->id)){

                    Cart::update($product->id, array(
                        'quantity' => array(
                            'relative' => false,
                            'value' => $quantity,
                        ),
                    ));

                   }else{
                Cart::add(array(
                    'id' => $product->id,
                    'name' => $product->name,
                    'price' => $product->price,
                    'quantity' => $quantity,
                    'attributes' => ['slug'=>$product->slug,
                    'added_cart_no'=>Cart::getContent()->count() == 1 ?
                        Cart::getContent()->count() +1 : 1 ]
                ));
                }
                $response['error'] = false;
                $shipping = Setting::select('id', 'text')->where('slug', 'shipping_price')->first()['text'];
                $grand_total = Cart::getSubTotal()+$shipping;
                $response['data'] = ['id'=>$product->id,'price'=>$product->price,'quantity'=>$quantity,'cart_total_qty'=> Cart::getContent()->count() ,
                'cart_total'=> Cart::getSubTotal(),'grand_total'=> $grand_total,'shipping'=>$shipping,'session'=>cartItems()];
                $response['message'] = '<span class="session_message">Success The Product <span style="color:seagreen">('.$product->name.')</span> Has Been Added To Cart List</span>';
                if($request->has('from') && $request->from == 'wishlists'){
                    WishList::destroy($request->wishlist_id);
                }
                return response()->json(json_encode($response));
            }catch (Exception $exception){
                \Log::alert('at product add cart '.$exception->getMessage());
            }


        }

        public function updateToCart(Request $request){
            $response['error'] = true;

            $request->has('quantity') ? $quantity = $request->quantity : $quantity = 1;

            if($products = Product::find($request->id)){
                    if(\Cart::get($products->id)){
                        \Cart::update($products->id, array(
                            'quantity' => array(
                                'relative' => false,
                                'value' => $quantity,
                            ),
                        ));
                        $response['html'] = ['id'=>$products->id,'price'=>$products->price,'cart_total_qty'=> \Cart::getContent()->count() ,'cart_total'=> Cart::getSubTotal(),'session'=>cartItems()];
                        $response['error'] = false;
                        $response['message'] = 'Success The Product ' .$products->name.' quanity is update to '.Cart::get($request->id)->quantity;
                    }else{
                        $response['message'] = 'Sorry The Product Is Out of Session Or Cookie Try Refresh The Link';
                    }
            }else{
                $response['message'] = 'Sorry Product Does Not Exits';
            }
            return response()->json(json_encode($response));
        }

        public function destroy(Request $request){
            $product_id = $request->product_id;
            $response = array();
            $response['error'] = true;
            if($product = Product::find($product_id)){
                if(Cart::get($product_id)){
    //                return parent::getCartItems();
                    Cart::remove($product_id);
                    $response['error'] = false;
                    $shipping = \App\Model\Setting::select('id', 'text')->where('slug', 'shipping_price')->first()['text'];
                    $response['data'] = ['id'=>$product->id,'price'=>$product->price,'cart_total_qty'=> Cart::getContent()->count() ,'cart_total'=> Cart::getSubTotal(),'total'=> Cart::getSubTotal()+$shipping,'session'=>cartItems()];
                    $response['message'] = '<span class="session_message">Success The Selected Products <span style="color:seagreen">('.$product->name.')</span> Has Been Added To Cart List</span>';
                }else{
                    $response['message'] = 'Sorry Product Was Not In The Cart List';
                }
            }else{
                $response['message'] = 'Sorry The Product Was Not Found On Database';
            }
            return response()->json(json_encode($response));
        }
}
