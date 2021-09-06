<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Model\Product;
use App\Model\WishList;
use Illuminate\Http\Request;
use Cart;
use Illuminate\Support\Facades\Session;

class WishListController extends BaseController
{

    public function index()
    {
        $wishlists = Wishlist::where([
            'user_id' => auth()->id()
        ])->get();
        return view(parent::loadViewData('front.user.wishlists'), compact('wishlists'));
    }

    public function store(Request $request)
    {
        Session::put('redirect', \URL::full());
        $response['error']=true;
        if (auth()->guest()) {
            Session::put('redirect', \URL::full());
            $response['message'] = 'Login To Add Product To Wishlist';
        }

        $productId = $request->product_id;
        $product = Product::find($productId);

        if(isInWishlist($productId)){
            $response['message'] = 'The Product ('.$product->name.') Is Already Added To Your WishLists';
        }else{
            WishList::create(
                ['product_id' => $productId,'user_id'=>auth()->user()->id]
            );
            $response['error']=false;
            $response['message'] = 'Success The Product ('.$product->name.') Has Been Added To WishLists';
        }

        return response()->json(json_encode($response),200);
    }

    public function destroy(Request $request){
        $response['error'] = true;
        if(!$wl = WishList::find($request->wishlist_id)){
            $response['message'] = 'Sorry Product Not Found';
      return response()->json(json_encode($response));
        }else{
            $wl->delete();
            $response['error'] = false;
            $response['message'] = 'The Product '.$wl->product->name.' has been removed from wishlists';
      return response()->json(json_encode($response));
        }
    }
}
