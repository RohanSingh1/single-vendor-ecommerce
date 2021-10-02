<?php

namespace App\Http\Controllers;

use App\Model\Notifications;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;

class DashboardController extends Controller
{

    public function __construct(Request $request)
    {
        $this->middleware('auth');
        $this->middleware('AdminRoleValidation');
    }

     public function notifications_list(){
        return view('backend.all_notifications');
    }

    public function delete_notifications(Request $request){
        if(!$notification = Notifications::find($request->id)){
            $request->session()->flash('error','Sorry The Selected Notifications Has Found Or Has Been Deleted');
            return redirect()->back();
        }
        $notification->delete();
        $request->session()->flash('success','Notification Deleted');
        return redirect()->back();
    }

    public function new_notify(Request $request){
        $data = $request->new_notification;
        $response['error'] = true;
                try {
                    $response['error'] = false;
                    $response['html'] = view('backend.layouts.notifications',compact('new'))->render();
                    return response()->json($response);
                } catch (\Throwable $e) {
                }
                return response()->json($response);
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
        return view('backend.dashboard');
    }

}
