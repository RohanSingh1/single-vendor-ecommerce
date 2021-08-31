<?php

namespace App\Http\Controllers\Front;

use App\Model\Product;
use App\Model\Setting;
use Illuminate\Http\Request;
use Cart;

class CartController extends BaseController
{
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
