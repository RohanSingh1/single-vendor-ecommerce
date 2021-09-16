<?php

use App\Model\Brand;
use App\Model\Setting;
use App\Model\Category;
use App\Model\Coupon;
use App\Model\Menu;
use App\Model\MenuItem;
use App\Model\Product;
use App\Model\WishList;
use Intervention\Image\Facades\Image;

function product_image($product){
    if (count($product->thumbnailImage()->get()) > 0) {
        $p_image = $product
            ->thumbnailImage()
            ->get()[0]
            ->getURl();
    } elseif (count($product->featuredImage()->get())  > 0) {
       $p_image = $product
       ->featuredImage()
       ->get()[0]
       ->getURl();
    }
    elseif ($product->getFirstMedia() != null) {
        $p_image = $product
            ->getMedia('products')
            ->get(0)
            ->getURl();
    } else {
        $p_image = asset('storage/defaults.png');
    }
    return $p_image;
}

function product_price($product,$data,$currency=false){
    $p_data = [];
    $p_data['new_price'] = $product->price;
    $p_data['old_price'] = $product->old_price;
    if ($p_data['old_price'] != null || $p_data['old_price'] != 0) {
        $p_data['discount_prices'] = $p_data['old_price'] - $p_data['new_price'];
        $p_data['discount_percentage'] = round(($p_data['discount_prices']  * 100) / $p_data['new_price']);
    }
    if($data !='discount_percentage' && $currency){
        return currency_type().' '.$p_data[$data];

    }else{
        return $p_data[$data];
    }
}

function mainMenu($menu)
    { 
//        return Cache::remember('menu-item-' . $menu,60, function () use ($menu) {
            $menuId = Menu::whereSlug('main-menu')->active()->first();
            if ($menuId) {
                return MenuItem::where('menu_id', $menuId->id)
                    ->parentOnly()
                    ->get();
            } else {
                return [];
            }
}


function footerMenu($menu)
    {
        $menuId = Menu::whereSlug($menu)->active()->first();
        if ($menuId) {
            return MenuItem::whereMenuId($menuId->id)
                ->orderBy('order')
                ->parentOnly()
                ->with('publishedPost', 'menu')
                ->get();
        } else {
            return [];
        }
    }

function currency_type(){
    $ct = Setting::where('slug', 'currency_type')->first();
    return $ct->text;
}

function get_price_check_coupon(){
    $data['total'] = 0;
    $data['shipping'] = Setting::select('id', 'text')->where('slug', 'shipping_price')->first()['text'];
    if(isset($_COOKIE['coupon_code'])){
        $coupon = Coupon::where('coupon_code',$_COOKIE['coupon_code'])->first();
        if($coupon == null){
          setcookie('coupon_code', "", time() - 1);
          return redirect()->route('cart.index');
        }
        foreach(\Cart::getContent() as $cart){
            $ids[] = $cart->id;
        }
        $data['coupon_discount'] = 0;
        $data['coupon_discount_total'] = 0;
        $test = [];
        $have = Product::whereIn('id',$ids)->pluck('id')->toArray();
        $data['in'] = false;
        foreach(\Cart::getContent() as $key=>$cc){
            $product =  Product::find($cc->id);
            $price = $product->price != '' ? $product->price : $product->old_price;
            if(in_array($cc->id,$coupon->products()->pluck('products.id')->toArray())){
              $data['in'] = true;
                if($coupon->type == 'flat_discounts'){
                    $data['coupon_discount']=$coupon->value;
                    $data['coupon_discount_total'] = $coupon->value*$cc->quantity+$data['coupon_discount_total'];
                  }elseif ($coupon->type == 'percentage_discounts'){
                    $data['coupon_discount']=$price*$coupon->value/100;
                    $data['coupon_discount_total'] = $product->price*$coupon->value/100*$cc->quantity+$data['coupon_discount_total'];
                }
               $now_price = $price*$cc->quantity;

               $data['quantity'] = $cc->quantity;
               $data['products'][] = [
                   'name'=>$cc->name,
                   'price'=>$product->price != '' ? $product->price : $product->old_price,
                   'quantity'=>$cc->quantity,
               ];
            }else{
                $data['quantity'] = $cc->quantity;
                $now_price = $price*$cc->quantity;
            }
               $data['total'] = $data['total']+$now_price;
        }
        $data['total']=$data['total']+$data['shipping']-$data['coupon_discount_total'];
        return $data;
    }
    $data['sub_totals'] = \Cart::getSubTotal();
    $data['total'] = \Cart::getSubTotal()+$data['shipping'];
    return $data;
}

function isInWishlist( $productId ) {
    return WishList::where( 'user_id', '=', auth()->id())
    ->where( 'product_id', '=', $productId )->first();
}


function cartItems()
    {
        $data = [];
        foreach (\Cart::getContent() as $key => $item) {
            $data[$key] = $item;
            $data[$key]->product = Product::find($item->id);
        }
        return $data;
    }


function createPostSlug($postTitle)
    {
        $replaceable = array(' ', '/', '?', '(', ')','.',',','%','$','!','^');
        return str_replace($replaceable, '-', strtolower($postTitle));
    }
function image_post_max_size()
{
    $data = Setting::where('slug', 'image_post_max_size')->first();
    if (isset($data)) {
        $value = $data->value;
    } else {
        $value = 2 * 1024;
    }
    return $value;
}

function file_post_max_size()
{
    $data = Setting::where('slug', 'file_post_max_size')->first();
    if (isset($data)) {
        $value = $data->value;
    } else {
        $value = 2 * 1024;
    }
    return $value;
}

function site_logo()
{
    return Setting::where('slug', 'site-logo')->first();
}

function category()
{
    return Category::get();
}

function brand()
{
    return Brand::get();
}

function allColors($slug)
{
    return \Illuminate\Support\Facades\Cache::rememberForever('all-colors', function () use ($slug) {
        return Setting::where('slug', $slug)->get();
    });
}

function colorCacheName($slug)
{
    return settingCacheName('color', $slug);
}

function positionCacheName($slug)
{
    return settingCacheName('position', $slug);
}

function settingCacheName($settingType, $slug)
{
    return 'setting-' . $settingType . '-' . $slug . '-' . auth('admin')->user()->id;
}

function settingColor($slug)
{
    return \Illuminate\Support\Facades\Cache::rememberForever(colorCacheName($slug), function () use ($slug) {
        $setting = \App\Model\SettingsUser::where('slug', $slug)
            ->where('user_id', auth('admin')->user()->id)
            ->first();
        if ($setting) {
            $data= Setting::find($setting->settings_id);
        } else {
            $data = Setting::where('slug', $slug)->active()->first();
        }
        return $data->value;
    });
}

function settingPosition($slug)
{
    return \Illuminate\Support\Facades\Cache::rememberForever(positionCacheName($slug), function () use ($slug) {
        $data = \App\Model\SettingsUser::where('slug', $slug)->where('user_id', auth('admin')->user()->id)->first();
        if ($data) {
            return $data->active;
        } else {
            return 0;
        }
    });
}


function makeImageForPublish($img, $name, $price)
{
    $template = Image::make('images/temp/template.png')->resize(3840, 3840);
    $nameTemplate = Image::make('images/temp/name.png')->resize(3840, 3840);
    $priceTemplate = Image::make('images/temp/price-template.png')->resize(3840, 3840);
    $img = Image::make($img)->resize(2600, 2600);
    $priceTemplate->text('Rs.' . $price, 340, 2730, function ($font) {
        $font->file(public_path('backend/fonts/ArefRuqaa.ttf'));
        $font->size(110);
        $font->align('center');
        $font->valign('center');
        $font->color('#fff');
    });
    $priceTemplate->text($name, 2000, 320, function ($font) {
        $font->file(public_path('backend/fonts/SCHLBKB.ttf'));
        $font->size(160);
        $font->align('center');
        $font->valign('top');
        $font->color('#4a72d2');
    });
    $template->insert($img, 'center');
    $template->insert($nameTemplate);
    $template->insert($priceTemplate);
    return $template;
}

function switch_case_check($val)
{
    $data = '';
    switch ($val) {
        case 1:
        case  true:
            $data = 1;
            break;
        case 0:
        case false:
            $data = 0;
            break;
    }
    return $data;
}

function deleteCheckForeignKey($data)
{
    try {
        $data->delete();
        return 204;
    } catch (\Illuminate\Database\QueryException $e) {
        if ($e->getCode() == "23000") {
            return 23000;
        }
    }
}

if (!function_exists('deleteFile')) {
    /**
     * this is method can be used to delete file if exists
     * @param $string
     */
    function deleteFile($filepath)
    {
        if (File::exists($filepath)) {
            unlink($filepath);
        }
    }
}
function showEditDeleteAction($id, $route, $show = '', $edit = '', $delete = '')
{
    $edit = editAction($id, $route, $edit);
    $delete = deleteAction($id, $route, $delete);
    $show = showAction($id, $route, $show);
    return
        '<div class="d-flex flex-row">' .
        $show . $edit . $delete
        . '</div>';
}

function editDeleteAction($id, $route, $edit = '', $delete = '')
{
    $edit = editAction($id, $route, $edit);
    $delete = deleteAction($id, $route, $delete);
    return
        '<div class="d-flex flex-row">' .
        $edit . $delete
        . '</div>';
}

function showAction($id, $show, $optional = '')
{
    if ($optional) {
        $route = $show . '.' . $optional;
    } else {
        $route = $show . '.show';
    }
    return ' <a href="' . route($route, $id) . '" class="btn btn-sm btn-success mr-1 " ><i class ="fa fa-eye"></i></a>';
}

function editAction($id, $edit, $optional = '')
{
    if ($optional) {
        $route = $edit . '.' . $optional;
    } else {
        $route = $edit . '.edit';
    }
    return '<a href="' . route($route, $id) . '" class="btn btn-sm btn-warning mr-1 "><i class ="fa fa-edit"></i></a> ';
}

function deleteAction($id, $delete, $optional = '')
{
    if ($optional) {
        $route = $delete . '.' . $optional;
    } else {
        $route = $delete . '.destroy';
    }
    return '
		<form action= "' . route($route, $id) . '" method="POST" accept-charset ="UTF-8" class="form-inline ">
			<input type="hidden" value="DELETE" name="_method">
			<input  name="_token" type="hidden" value="' . csrf_token() . '">
			<input type="hidden" name="deleteType" value="delete">
			<button class="btn btn-danger btn-sm delete-confirm" type="submit" value="delete"><i class ="fa fa-trash"></i></button>
		</form>
	';
}
function forceDeleteAction($id, $delete, $optional = '')
{
    if ($optional) {
        $route = $delete . '.' . $optional;
    } else {
        $route = $delete . '.destroy';
    }
    return '
		<form action= "' . route($route, $id) . '" method="POST" accept-charset ="UTF-8" class="form-inline ">
			<input type="hidden" value="DELETE" name="_method">
			<input  name="_token" type="hidden" value="' . csrf_token() . '">
			<input type="hidden" name="deleteType" value="forceDelete">
			<button class="btn btn-danger btn-sm delete-confirm" type="submit" value="delete"><i class ="fa fa-trash"></i></button>
		</form>
	';
}
function recoverAction($id, $delete, $optional = '')
{
    if ($optional) {
        $route = $delete . '.' . $optional;
    } else {
        $route = $delete . '.destroy';
    }
    return '
		<form action= "' . route($route, $id) . '" method="POST" accept-charset ="UTF-8" class="form-inline ">
			<input type="hidden" value="DELETE" name="_method">
			<input  name="_token" type="hidden" value="' . csrf_token() . '">
			<input type="hidden" name="deleteType" value="recover">
			<button class="btn btn-success btn-sm recover-confirm" type="submit" value="delete"><i class ="fa fa-undo"></i></button>
		</form>
	';
}

function activeToggle($route, $id, $activeValue, $text1, $text2)
{
    if ($activeValue == true) {
        $text = $text2;
        $btnClass = 'btn-danger';
    } else {
        $text = $text1;
        $btnClass = 'btn-success';
    }
    return toggleButton($route, $id, $text, $btnClass);
}

function toggleButton($route, $id, $text, $class = '')
{
    if ($class == '') {
        $class = 'btn-success';
    }
    return '
		<form method="post" action=' . route($route, $id) . '>
			<input type="hidden" value="' . csrf_token() . '" name="_token">
			<input type="hidden" value="PUT" name="_method">
			<button class="btn ' . $class . '" type="submit">' . $text . '</button>
		</form>';
}

function makePrimary($route, $id, $text = '')
{
    if ($text == '') {
        $text = 'Make Primary';
    }
    return toggleButton($route, $id, $text);

}

if (!function_exists('str_slug')) {
    /**
     * Helper to grab the application name.
     *
     * @param $title
     * @return mixed
     */
    function str_slug($title)
    {
        $replaceable = array(' ', '/', '?', '(', ')');
        return str_replace($replaceable, '-', strtolower($title));
    }
}

if (!function_exists('buildCategory')) {
    function buildCategory($categoryId)
    {
        $category = Category::find($categoryId);
        $cat_array = [];
        if (!empty($category->activeParent)) {
            array_push($cat_array, $category->activeParent->id);
            if (!empty($category->activeParent->activeParent)) {
                array_push($cat_array, $category->activeParent->activeParent->id);
            }
        }
        array_push($cat_array, $categoryId);
//        dd($cat_array);
        return $cat_array;
    }
}
if (!function_exists('active_column_check')) {
    function active_column_check($active)
    {
        switch ($active) {
            case 1:
            case true:
                return '<span class="text-center text-success fas fa-check fa-lg p-2 "></span>';
                break;
            case false:
            case 0:
                return '<span class="text-center text-danger fas fa-times fa-lg p-2"></span>';
                break;
        }
    }
}

if (!function_exists('storeMeta')) {
    function storeMeta($model, $request)
    {
        $model->meta()->create(setMetaData($request));
    }
}
if (!function_exists('updateMeta')) {
    function updateMeta($model, $request)
    {
        if ($model->meta) {
            $model->meta->update(setMetaData($request));
        } else {
            $model->meta()->create(setMetaData($request));
        }
    }
}

if (!function_exists('setMetaData')) {
    function setMetaData($request)
    {
        $data['meta_title'] = $request->meta_title ?? $request['meta_title'] ?? '';
        $data['meta_keyword'] = $request->meta_keyword ?? $request['meta_keyword'] ?? '';
        $data['meta_desc'] = $request->meta_desc ?? $request['meta_desc'] ?? '';
        return $data;
    }
}
if (!function_exists('generateUniqueSlug')) {
    /**
     * this is method can be used to generate slug
     * @param string $classPath eg: App\Models\Page
     * @param $title
     * @return $string
     */
    function generateUniqueSlug($classPath, $title)
    {
        $temp = createPostSlug($title);
        if (!($classPath::where('slug', $temp)->withTrashed()->get()->isEmpty())) {
            $i = 1;
            $newslug = $temp . '-' . $i;
            while (!($classPath::where('slug', $newslug)->get()->isEmpty())) {
                $i++;
                $newslug = $temp . '-' . $i;
            }
            $temp = $newslug;
        }
        return $temp;
    }
}
if (!function_exists('generateUniqueUrl')) {
    /**
     * this is method can be used to generate url
     * @param string $classPath eg: App\Models\Page
     * @param $title
     * @return $string
     */
    function generateUniqueUrl($classPath, $title)
    {
        $temp = createPostSlug($title);
        if (!($classPath::where('url', $temp)->get()->isEmpty())) {
            $i = 1;
            $newslug = $temp . '-' . $i;
            while (!($classPath::where('url', $newslug)->get()->isEmpty())) {
                $i++;
                $newslug = $temp . '-' . $i;
            }
            $temp = $newslug;
        }
        return url($temp);
    }
}
if (!function_exists('get_general_settings_text')) {
    function get_general_settings_text($slug)
    {
        return cache()->remember('general-settings-text-' . $slug, 60 * 60, function () use ($slug) {
            return Setting::select('id', 'text')->where('slug', $slug)->where('text', '!=', '')->first() ?? '';
        });
    }
}
if (!function_exists('get_general_settings_file')) {
    function get_general_settings_file($slug)
    {
        return cache()->remember('general-settings-file-' . $slug, 60 * 60 * 60, function () use ($slug) {
            return Setting::select('file', 'slug')->where('slug', $slug)->first() ?? '';
        });
    }
}
if (!function_exists('app_name')) {
    /**
     * Helper to grab the application name.
     *
     * @return mixed
     */
    function app_name()
    {
        return config('app.name');
    }
}
function catMenuBuilder()
{
    return cache()->remember('category-menu', 60 * 60 * 24, function () {
        return \App\Model\Category::active()
            ->parentOnly()
            ->with('activeChildrenCategories', 'parent', 'activeChildrenCategories.activeChildren')
            ->withCount('activeChildrenCategories', 'activeChildren')
            ->orderBy('order')->get();
    });
}

function catParentBuilder()
{
    return cache()->remember('category-parent', 60 * 60 * 24, function () {
        return \App\Model\Category::select('id', 'name')->active()
            ->parentOnly()
            ->orderBy('order')->get();
    });
}

if (!function_exists('targetBlank')) {
    function targetBlank($val)
    {
        if ($val == 1) {
            return 'target="_blank" rel="noopener" ';
        } else {
            return '';
        }
    }
}
