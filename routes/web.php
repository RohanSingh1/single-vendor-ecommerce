<?php
//if (!defined('NO_IMAGE')) define('NO_IMAGE', 'no-image.jpg');
//if (!defined('NO_IMAGE_ASSET')) define('NO_IMAGE_ASSET', asset('no-image.jpg'));

// Route::get('/', function () {
//     return view('backend.dashboard');
// });

Route::get('test',function(){
    dd();
    setcookie('address','fff', time()+360000);
    if(isset($_COOKIE['address']) && !empty($_COOKIE['address'])){
        setcookie('address', "", time() - 1);
    }
});

// Route::get('/', 'Frontend\HomeController@index')->name('index');
Auth::routes();

Route::post('currency', 'Frontend\HomeController@change_currency')->name('change_currency');

//requested products
Route::get('/request_product', 'Frontend\ContactUsController@requested_product')->name('requested_product.create');
Route::post('/requested_product/store', 'Frontend\ContactUsController@store_requested_product')->name('requested_product.store')->middleware('auth');

Route::post('/product_feedback/store', 'Frontend\ProductController@store_customer_feedback')->name('customer_feedback.store');

Route::get('/product/{slug}', 'Frontend\ProductController@show')->name('product.show');
Route::get('/product/{slug}/{email}/{token}', 'Frontend\ProductDownloadController@index')->name('product.download.show');
Route::post('/newsletter/store', 'NewsletterController@store')->name('newsletter.store');

Route::group(['namespace' => 'Frontend'], function () {
    Route::get('/search/{categoryId?}{q?}', 'SearchProductController@index')->name('search-results');
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
Route::get('cart', 'Frontend\CartController@index')->name('frontend.cart.index');
Route::post('addToCart', 'Frontend\CartController@addToCart')->name('frontend.cart.add');
Route::post('updateToCart', 'Frontend\CartController@updateToCart')->name('frontend.cart.update');
Route::post('cart/destroy','Frontend\CartController@destroy')->name('frontend.cart.destroy');

Route::group(['namespace'=>'Frontend\\','as'=>'frontend.','middleware'=>'auth'], function () {

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

    Route::resource('brand', 'BrandController');
    Route::get('/api/brand', 'BrandController@apiBrand')->name('api.brand');
    Route::post('category/saveOrder', ['uses' => 'CategoryController@saveOrder', 'as' => 'category.saveOrder']);
    Route::resource('category', 'CategoryController');
    Route::resource('supplier', 'SupplierController');
    Route::get('/api/supplier', 'SupplierController@apiSupplier')->name('api.supplier');
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

Route::get('/{slug}', 'Frontend\HomeController@show')->name('page.show');
