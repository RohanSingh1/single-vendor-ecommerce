<?php
//if (!defined('NO_IMAGE')) define('NO_IMAGE', 'no-image.jpg');
//if (!defined('NO_IMAGE_ASSET')) define('NO_IMAGE_ASSET', asset('no-image.jpg'));

// Route::get('/', function () {
//     return view('backend.dashboard');
// });

use App\Model\Order;
use App\Model\Product;
use Illuminate\Support\Facades\Cookie;

Route::get('test',function(){
    $pr = Product::find(5);
    dd(product_image($pr));
    dd($_COOKIE['address']);
    $ad = Order::find(29);
    dd(unserialize($ad->shipping_address));
});

Route::get('/', 'Front\HomeController@index')->name('index');
Auth::routes();

Route::get('coupon_products/{coupon}','Front\HomeController@coupon_products')->name('coupon_products');
Route::get('deal_products/{deal}','Front\HomeController@deal_products')->name('deal_products');
Route::get('show_all/{product}','Front\HomeController@show_all')->name('show_all');
Route::get('product-filter','Front\FilterController@product_filter')->name('product-filter');

Route::post('currency', 'Front\HomeController@change_currency')->name('change_currency');
Route::get('/product/{slug}', 'Front\HomeController@product_show')->name('product.show');
Route::get('/faq', 'Front\HomeController@faq')->name('faq');
Route::get('/offers', 'Front\HomeController@offers')->name('offers');
//cart
Route::get('cart', 'Front\CartController@index')->name('front.cart.index');
Route::post('addToCart', 'Front\CartController@addToCart')->name('front.cart.add');
Route::post('updateToCart', 'Front\CartController@updateToCart')->name('front.cart.update');
Route::post('cart/destroy','Front\CartController@destroy')->name('front.cart.destroy');

//search
   Route::post('search_now', 'Front\HomeController@search_now')->name('search_now');
   Route::get('search','Front\HomeController@search_now')->name('search');

Route::post('/product_feedback/store', 'Front\ProductController@store_customer_feedback')->name('customer_feedback.store');

Route::get('/product/{slug}/{email}/{token}', 'Front\ProductDownloadController@index')->name('product.download.show');
Route::post('/newsletter/store', 'Front\HomeController@newsletter')->name('newsletter.store');

Route::group(['namespace' => 'Front'], function () {
    Route::get('/category', 'CategoryController@index')->name('category.index');
    Route::get('/category/{slug}', 'CategoryController@show')->name('category.show');
    Route::post('/no-products', 'RequestProductController@store')->name('no-products.store');
    Route::get('/contact-us', 'HomeController@contact_us')->name('contact-us.index');
    Route::post('/contact-us', 'HomeController@storeContactUs')->name('contact-us.store');
    Route::get('/thank-you', 'RequestProductController@show')->name('thank-you');
});
//checkouts
Route::get('checkout','Front\CheckoutController@checkout')->name('front.checkout');
Route::post('checkout','Front\CheckoutController@checkoutStore')->name('front.checkout.store');
//cart
Route::get('cart', 'Front\CartController@index')->name('front.cart.index');
Route::post('addToCart', 'Front\CartController@addToCart')->name('front.cart.add');
Route::post('updateToCart', 'Front\CartController@updateToCart')->name('front.cart.update');
Route::post('cart/destroy','Front\CartController@destroy')->name('front.cart.destroy');

Route::post('/addShippingAddress', 'Front\AddressController@addShippingAddress')->name('front.addShippingAddress');
Route::post('/addBillingAddress', 'Front\AddressController@addBillingAddress')->name('front.addBillingAddress');

Route::group(['namespace'=>'Front\\','as'=>'front.','middleware'=>'auth'], function () {

    // coupon discount
    Route::post('/apply_coupon', 'CartController@apply_coupon')->name('apply_coupon');
    Route::post('/remove_oupon', 'CartController@removeCoupon')->name('removeCoupon');
    //address
    Route::post('/updateAddress', 'AddressController@updateAddress')->name('updateAddress');
    Route::get('/editmyaddress', 'AddressController@editmyaddress')->name('editmyaddress');
    Route::get('/myaddress', 'AddressController@myaddress')->name('myaddress');
    //shipping address




    Route::get('/wishlists', 'WishListController@index')->name('wishlists');
    Route::post('/wishlists', 'WishListController@store')->name('wishlist.store');
    Route::post('/wishlists/destroy', 'WishListController@destroy')->name('wishlist.destroy');

    // address
    Route::resource('address', 'AddressController');
    Route::get('my_address', 'AddressController@my_address')->name('my_address');

    Route::get('/dashboard', 'DashboardController@index')->name('dashboard');
    Route::post('/uploadAvatar', 'DashboardController@uploadAvatar')->name('uploadAvatar');
    //my orders
    Route::get('/myorders', 'DashboardController@myorders')->name('myorders');
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
    Route::get('/contact_messages', 'ContactMessageController@index')->name('contact_messages.index');
    Route::get('/api/contact_messages', 'ContactMessageController@apicontact_messages')->name('api.contact_messages');
    Route::get('/contact_messages/{id}', 'ContactMessageController@show')->name('show_contact_messages');
    Route::post('/contact_messages', 'ContactMessageController@destroy')->name('destroy_contact_messages');
    //locations
    Route::resource('locations', 'LocationController');
    Route::get('/api/locations', 'LocationController@apilocations')->name('api.locations');
    //delivery name
    Route::resource('delivery_name', 'DeliveryNameController');
    Route::get('/api/delivery_name', 'DeliveryNameController@apidelivery_name')->name('api.delivery_name');
    //advertisement
    Route::resource('advertisement', 'AdvertisementController');
    Route::get('/api/advertisement', 'AdvertisementController@apiAdvertisement')->name('api.advertisement');
    //faq
    Route::resource('faq', 'FaqController');
    Route::get('/api/faq', 'FaqController@apifaq')->name('api.faq');
    // coupon discount
    Route::resource('coupons', 'CouponController');
    Route::get('/api/coupon', 'CouponController@apiCoupon')->name('api.coupon');
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
    //customer
    Route::resource('/customers', 'CustomersController');
    Route::get('/api/customers', 'CustomersController@apiCustomers')->name('api.customers');
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
    Route::get('/my-dashboard', 'DashboardController@index')->name('my-dashboard');
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
