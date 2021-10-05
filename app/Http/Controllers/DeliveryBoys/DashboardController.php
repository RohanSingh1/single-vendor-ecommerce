<?php

namespace App\Http\Controllers\DeliveryBoys;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth','DeliveryRoleValidation']);
    }

    public function searchProduct(Request $request)
    {
      $term = trim($request->input('q'));
      if (empty($term)) {
        return response()->json([], 200);
      }

      $products = DB::table('products')->where('name', 'like', '%' . $term . '%')->orderBy('name')->take(15)->get();

      $formattedProducts = [];

      foreach ($products as $productKey => $productValue) {
        $formattedProducts[] = ['id' => $productValue->id, 'text' => $productValue->name];
      }

      return response()->json($formattedProducts, 200);

    }

    public function index(){
        return view('backend.delivery_boys.dashboard');
    }

}
