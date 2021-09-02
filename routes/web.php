<?php
//if (!defined('NO_IMAGE')) define('NO_IMAGE', 'no-image.jpg');
//if (!defined('NO_IMAGE_ASSET')) define('NO_IMAGE_ASSET', asset('no-image.jpg'));

// Route::get('/', function () {
//     return view('backend.dashboard');
// });

use App\Model\Product;

Route::get('test',function(){
    foreach (\Cart::getContent() as $key => $item) {
        dump(Cart::getSubTotal());
        dd(Cart::getTotal());
    }
    dd();
    \Cart::remove([1,2,3,4,5]);
    dd();
    return view('front.index');
    setcookie('address','fff', time()+360000);
    if(isset($_COOKIE['address']) && !empty($_COOKIE['address'])){
        setcookie('address', "", time() - 1);
    }
});

Route::get('/', 'Front\HomeController@index')->name('index');
Auth::routes();

Route::post('currency', 'Front\HomeController@change_currency')->name('change_currency');
Route::get('/product/{slug}', 'Front\HomeController@show')->name('product.show');
//cart
Route::get('cart', 'Front\CartController@index')->name('front.cart.index');
Route::post('addToCart', 'Front\CartController@addToCart')->name('front.cart.add');
Route::post('updateToCart', 'Front\CartController@updateToCart')->name('front.cart.update');
Route::post('cart/destroy','Front\CartController@destroy')->name('front.cart.destroy');

//search
   Route::post('search_now', 'Front\HomeController@search_now')->name('search_now');
   Route::get('search','Front\HomeController@search_now')->name('search');

//requested products
Route::get('/request_product', 'Front\ContactUsController@requested_product')->name('requested_product.create');
Route::post('/requested_product/store', 'Front\ContactUsController@store_requested_product')->name('requested_product.store')->middleware('auth');

Route::post('/product_feedback/store', 'Front\ProductController@store_customer_feedback')->name('customer_feedback.store');

Route::get('/product/{slug}/{email}/{token}', 'Front\ProductDownloadController@index')->name('product.download.show');
Route::post('/newsletter/store', 'Front\HomeController@newsletter')->name('newsletter.store');

Route::group(['namespace' => 'Front'], function () {
    Route::get('/category', 'CategoryController@index')->name('category.index');
    Route::get('/category/{slug}', 'CategoryController@show')->name('category.show');
    Route::post('/no-products', 'RequestProductController@store')->name('no-products.store');
    Route::get('/contact-us', 'ContactUsController@index')->name('contact-us.index');
    Route::post('/contact-us', 'ContactUsController@store')->name('contact-us.store');
    Route::get('/thank-you', 'RequestProductController@show')->name('thank-you');
    Route::get('/faqs', 'FaqsController@index')->name('faqs.index');
    Route::group(['as' => 'user.'], function () {
        Route::get('/dashboard', 'DashboardController@index')->name('dashboard');
        Route::post('/updateAddress', 'DashboardController@addressUpdate')->name('updateAddress');
    });

});

//cart
Route::get('cart', 'Front\CartController@index')->name('front.cart.index');
Route::post('addToCart', 'Front\CartController@addToCart')->name('front.cart.add');
Route::post('updateToCart', 'Front\CartController@updateToCart')->name('front.cart.update');
Route::post('cart/destroy','Front\CartController@destroy')->name('front.cart.destroy');

Route::group(['namespace'=>'Front\\','as'=>'front.','middleware'=>'auth'], function () {

    Route::post('wishlists/bulk_actions','WishListController@bulk_action')->name('wishlists.bulk_actions');
    Route::get('/wishlists', 'WishListController@index')->name('wishlists');
    Route::post('/wishlists', 'WishListController@store')->name('wishlist.store');
    Route::post('/wishlist/delete', 'WishListController@delete')->name('wishlist.delete');
// address
    Route::resource('address', 'AddressController');


    //my orders
    Route::get('/myorders', 'CartController@myorders')->name('myorders');
    Route::get('/myorders/order_details/{id}', 'CartController@order_details')->name('order_details');
    Route::post('myorders','CartController@order_remove')->name('myorder.order_remove');
    //product reviews
    Route::post('product_reviews','ProductController@reviews_store')->name('reviews_store');
    //orders
    Route::post('orders_store','CartController@orders_store')->name('orders_store');

});

Route::get('login/{provider}', 'Auth\LoginController@redirectToProvider');
Route::get('login/{provider}/callback', 'Auth\LoginController@handleProviderCallback');
//admin login starts here
Route::group(['namespace' => 'Admin\Auth', 'as' => 'admin.'], function () {
    Route::get('admin-login', 'LoginController@showLoginForm')->name('show-login');
    Route::post('admin-login', 'LoginController@login')->name('login');
    Route::post('admin-login/logout', 'LoginController@logout')->name('logout');
    Route::post('admin-login/password/email', 'ForgotPasswordController@sendResetLinkEmail')->name('password.email');
    Route::get('admin-login/password/reset', 'ForgotPasswordController@showLinkRequestForm')->name('password.request');
    Route::post('admin-login/password/reset', 'ResetPasswordController@reset');
    Route::get('admin-login/password/reset/{token}', 'ResetPasswordController@showResetForm')->name('password.reset');
});

// admins
Route::group(['middleware' => ['auth:admin','AdminRoleValidation'],'prefix' => 'admin', 'as' => 'admin.'], function () {

    Route::get('/dashboard', 'DashboardController@index')->name('dashboard');
    //advertisement
    Route::resource('advertisement', 'AdvertisementController');
    Route::get('/api/advertisement', 'AdvertisementController@apiAdvertisement')->name('api.advertisement');

    Route::post('category/saveOrder', ['uses' => 'CategoryController@saveOrder', 'as' => 'category.saveOrder']);
    Route::resource('category', 'CategoryController');

    Route::get('/products/show-price/{id}', 'ProductController@showPrice')->name('product.showPrice');
    Route::resource('products', 'ProductController');
    Route::get('api/products', 'ProductController@apiProduct')->name('api.product');
    Route::put('products/products-upload-image/{product}', 'ProductImageController@store')->name('products.image-upload.store');
    Route::put('products/products-upload-image/make-featured/{product}/{pImage}', 'ProductImageController@update')->name('products.image-upload.make-primary');
    Route::put('products/products-upload-image/make-thumbnail/{product}/{pImage}', 'ProductImageController@makeThumbnail')->name('products.image-upload.make-thumbnail');
    Route::delete('products/products-delete-image/{pImage}', 'ProductImageController@destroy')->name('products.image-upload.destroy');
    Route::delete('products/products-delete-image-all/{pImage}', 'ProductImageController@destroyAll')->name('products.image-upload.destroy-all.destroy');
    Route::get('products/product-image/datatable', 'ProductImageController@productImage')->name('datatable.product-image');
    Route::post('products/product-image/save-order', ['uses' => 'ProductImageController@saveOrder', 'as' => 'product-image.saveOrder']);

    Route::resource('customer-users', 'CustomerUserController');
    Route::get('/customer-user/datatable', 'CustomerUserController@apiCustomerUsers')->name('api.customer-users');
     // stepwise category
    Route::post('getParentNChildCats','ProductController@getParentNChildCats')->name('products.getParentNChildCats');

    //orders
    Route::resource('orders', 'OrderController')->except('create','store');
    Route::get('/api/order', 'OrderController@apiOrders')->name('api.order');

    Route::get('/search-product', 'DashboardController@searchProduct')->name('search.product');
    // deals
    Route::resource('deals', 'DealController');
    Route::get('/api/deal', 'DealController@apiDeal')->name('api.deal');
    //users
    Route::get('/users', 'UsersController@index')->name('users');
    Route::get('/api/users', 'UsersController@apiuser')->name('api.users');
    Route::post('/users/register', 'UsersController@store')->name('register.store');
    Route::get('/users/edit/{id}', 'UsersController@edit')->name('users.edit');
    Route::PUT('/users/update/{id}', 'UsersController@update')->name('users.update');
    Route::get('/users/{id}', 'UsersController@show')->name('users.show');
    Route::post('/delete', 'UsersController@destroy')->name('users.destroy');
    Route::group(['prefix' => 'cms'], function () {
        Route::put('sliders/make-primary/{slider}', 'SliderController@activeToggle')->name('sliders.active-toggle');
        Route::resource('sliders', 'SliderController');
        Route::get('api/sliders', 'SliderController@apiSlider')->name('api.slider');

        Route::resource('pages', 'PageController');
        Route::get('pages/data/table', 'PageController@apiDataTable')->name('datatable.pages');

        Route::get('newsletters', 'NewsletterController@index')->name('newsletters.index');
        Route::get('newsletters/data/table', 'NewsletterController@dataTable')->name('datatable.newsletters');

        Route::group(['as' => 'content-management.'], function () {
            Route::put('menus/change-selected', 'MenuController@changeSelected')->name('menus.change-selected');
            Route::put('menus/toggle-active/{menu}', 'MenuController@toggleActive')->name('menus.toggle-active');
            Route::resource('menus', 'MenuController');
            Route::post('menus/menu-item/saveOrder', ['uses' => 'MenuItemController@saveOrder', 'as' => 'menu-item.saveOrder']);
            Route::post('menus/menu-item/create', 'MenuItemController@store')->name('menu-item.store');
            Route::put('menus/menu-item/update/{menu}', 'MenuItemController@update')->name('menu-item.update');
            Route::delete('menus/menu-item/delete/{menuItem}', 'MenuItemController@destroy')->name('menu-item.destroy');

            Route::get('/settings', ['uses' => 'SettingController@index', 'as' => 'settings.index']);
            Route::post('/settings', ['uses' => 'SettingController@store', 'as' => 'settings.store']);

        });
    });
});


//delivery boys
Route::group(['middleware' => ['auth:admin','DeliveryRoleValidation'], 'as' => 'admin.', 'prefix' => 'admin','namespace' => 'DeliveryBoys'], function () {
    Route::get('/search-product', 'DashboardController@searchProduct')->name('search.product');
    Route::get('/my-dashboard', 'DashboardController@index')->name('dashboard');
     //orders
     Route::resource('delivery_orders', 'OrderController')->except('create','store');
     Route::get('/api/delivery_orders', 'OrderController@apiOrders')->name('api.delivery_orders');
    Route::get('testff',function(){
        dd('here');
    });

});

Route::get('/config-cache', 'CacheController@index');
Route::get('/clear-cache', 'CacheController@destroy');

Route::get('/{slug}', 'Front\HomeController@show')->name('page.show');
