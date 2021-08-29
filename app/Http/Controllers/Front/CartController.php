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
