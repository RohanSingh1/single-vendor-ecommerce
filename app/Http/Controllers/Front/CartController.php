<?php

namespace App\Http\Controllers\Front;

use App\Model\Coupon;
use App\Model\Product;
use App\Model\Setting;
use App\Model\WishList;
use Illuminate\Http\Request;
use Cart;

class CartController extends BaseController
{
    public function removeCoupon(Request $request){
	    if($request->has('coupon_code') && $request->coupon_code !=''){
            if(isset($_COOKIE['coupon_code']) && !empty($_COOKIE['coupon_code'])){
                setcookie('coupon_code', "", time() - 1);
            }
	        $request->session()->flash('success','Success The Coupon Has Been Removed');
        }
	    return redirect()->back();
    }

    public function apply_coupon(Request $request){
        if(!$coupon = Coupon::where('coupon_code',$request->coupon_code)->first()){
            $request->session()->flash('error','Sorry Coupon Does Not Exists Or Has Been Expired');
            return redirect()->back();
        }

        if($coupon->expiry_date < date('Y-m-d')){
            $request->session()->flash('error','Sorry The Coupon Has Been Expired');
            return redirect()->back();
        }
        setcookie('coupon_code', $request->coupon_code, time()+360000);
        $request->session()->flash('success','Success Coupon Applied');
        return redirect()->back();
    }

    public function addToCart(Request $request){
        $response['error'] = true;
        $request->has('quantity') ? $quantity = $request->quantity : $quantity = 1;


        try{
            $product = Product::where('slug',$request->slug)->firstOrFail();
            if($product->colors->count() > 0 || $product->size != ''){

            }
            //  if($request->sizes == '' || $request->colors == ''){
            //     $response['message'] = '<span class="error">Please Select Color And Size</span>';
            //     return response()->json(json_encode($response));
            // }
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
                'attributes' => ['slug'=>$product->slug,'sizes'=>$request->sizes,'colors'=>$request->colors,
                'added_cart_no'=>Cart::getContent()->count() == 1 ?
                    Cart::getContent()->count() +1 : 1 ]
            ));
            }
            $response['error'] = false;
            $coupon_discount = !empty(get_price_check_coupon()['coupon_discount_total']) ? get_price_check_coupon()['coupon_discount_total']:0;
            $shipping = Setting::select('id', 'text')->where('slug', 'shipping_price')->first()['text'];
            $total = Cart::getSubTotal()+$shipping-$coupon_discount;
            $response['data'] = ['id'=>$product->id,'price'=>$product->price,'coupon_discount_total'=>$coupon_discount,'quantity'=>$quantity,'cart_total_qty'=> Cart::getContent()->count() ,
            'cart_total'=> Cart::getSubTotal(),'total'=> $total,'shipping'=>$shipping,'session'=>cartItems()];
            $response['message'] = 'Success The Product ('.$product->name.') Has Been Added To Cart';
            $response['html'] = view(parent::loadViewData('front.layouts.cart'))->render();
            if($request->has('from') && $request->from == 'wishlists'){
                WishList::destroy($request->wishlist_id);
            }
            return response()->json(json_encode($response));
        }catch (Exception $exception){
            \Log::alert('at product add cart '.$exception->getMessage());
            $response['message'] = 'Sorry The Product Does Not Exists';
            return response()->json(json_encode($response));
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
                    $response['message'] = 'Success The Selected Product ('.$product->name.') Has Been Removed';
                }else{
                    $response['message'] = 'Sorry Product Was Not In The Cart List';
                }
            }else{
                $response['message'] = 'Sorry The Product Was Not Found On Database';
            }
            return response()->json(json_encode($response));
        }
}
