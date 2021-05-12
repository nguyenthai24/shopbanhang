<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
//front-end
Route::get('/', 'App\Http\Controllers\HomeController@index'); 
Route::get('/trang-chu', 'App\Http\Controllers\HomeController@index');
Route::post('/tim-kiem', 'App\Http\Controllers\HomeController@search');

//category trang chủ
Route::get('/danh-muc-san-pham/{slug_category_product}', 'App\Http\Controllers\CategoryProduct@show_category_home');
Route::get('/thuong-hieu-san-pham/{brand_slug}', 'App\Http\Controllers\BrandProduct@show_brand_home');
Route::get('/chi-tiet-san-pham/{product_slug}', 'App\Http\Controllers\ProductController@show_product');

//send-email
Route::get('/send-mail', 'App\Http\Controllers\HomeController@send_mail');
//
//Login facebook
Route::get('/login-facebook','App\Http\Controllers\AdminController@login_facebook');
Route::get('/admin/callback','App\Http\Controllers\AdminController@callback_facebook');


//back-end 
Route::get('/admin', 'App\Http\Controllers\AdminController@index');
Route::get('/dashboard', 'App\Http\Controllers\AdminController@showdashboard');
Route::get('/logout', 'App\Http\Controllers\AdminController@logout');
Route::post('/admin-dashborad', 'App\Http\Controllers\AdminController@dashboard');

//Category-Product

Route::get('/add-category-product', 'App\Http\Controllers\CategoryProduct@add_category_product');
Route::get('/all-category-product', 'App\Http\Controllers\CategoryProduct@all_category_product');

//{category_product_id} là tham số truyền vào theo đường dẫn và đc tên theo tùy ý
Route::get('/unactive-category-product/{category_product_id}', 'App\Http\Controllers\CategoryProduct@unactive_category_product');
Route::get('/active-category-product/{category_product_id}', 'App\Http\Controllers\CategoryProduct@active_category_product');

Route::get('/edit_category_product/{category_product_id}', 'App\Http\Controllers\CategoryProduct@edit_category_product');
Route::get('/delete_category_product/{category_product_id}', 'App\Http\Controllers\CategoryProduct@delete_category_product');

Route::post('/update-category-product/{category_product_id}', 'App\Http\Controllers\CategoryProduct@update_category_product');
Route::post('/save-category-product', 'App\Http\Controllers\CategoryProduct@save_category_product');


//brand-Product

Route::get('/add-brand-product', 'App\Http\Controllers\BrandProduct@add_brand_product');
Route::get('/all-brand-product', 'App\Http\Controllers\BrandProduct@all_brand_product');

//{brand_product_id} là tham số truyền vào theo đường dẫn và đc tên theo tùy ý
Route::get('/unactive-brand-product/{brand_product_id}', 'App\Http\Controllers\BrandProduct@unactive_brand_product');
Route::get('/active-brand-product/{brand_product_id}', 'App\Http\Controllers\BrandProduct@active_brand_product');

Route::get('/edit-brand-product/{brand_product_id}', 'App\Http\Controllers\BrandProduct@edit_brand_product');
Route::get('/delete-brand-product/{brand_product_id}', 'App\Http\Controllers\BrandProduct@delete_brand_product');

Route::post('/update-brand-product/{brand_product_id}', 'App\Http\Controllers\BrandProduct@update_brand_product');
Route::post('/save-brand-product', 'App\Http\Controllers\BrandProduct@save_brand_product');


//Product

Route::get('/add-product', 'App\Http\Controllers\ProductController@add_product');
Route::get('/all-product', 'App\Http\Controllers\ProductController@all_product');

//{brand_product_id} là tham số truyền vào theo đường dẫn và đc tên theo tùy ý
Route::get('/unactive-product/{product_id}', 'App\Http\Controllers\ProductController@unactive_product');
Route::get('/active-product/{product_id}', 'App\Http\Controllers\ProductController@active_product');

Route::get('/edit-product/{product_id}', 'App\Http\Controllers\ProductController@edit_product');
Route::get('/delete-product/{product_id}', 'App\Http\Controllers\ProductController@delete_product');

Route::post('/update-product/{product_id}', 'App\Http\Controllers\ProductController@update_product');
Route::post('/save-product', 'App\Http\Controllers\ProductController@save_product');

//cart
Route::post('/save-cart', 'App\Http\Controllers\CartController@save_cart');
Route::post('/update-cart', 'App\Http\Controllers\CartController@update_cart');
Route::post('/add-cart-ajax','App\Http\Controllers\CartController@add_cart_ajax');
Route::post('/update-cart-quantity', 'App\Http\Controllers\CartController@update_cart_quantity');
Route::get('/show-cart', 'App\Http\Controllers\CartController@show_cart');
Route::get('/gio-hang', 'App\Http\Controllers\CartController@gio_hang');
Route::get('/delete-to-cart/{rowId}', 'App\Http\Controllers\CartController@delete_to_cart');
Route::get('/delete-cart/{session_id}', 'App\Http\Controllers\CartController@delete_cart');
Route::get('/delete-all-product', 'App\Http\Controllers\CartController@delete_all_product');


// Check_coupons front-end
Route::post('/check-coupons', 'App\Http\Controllers\CartController@check_coupons');

// Coupons back-end
Route::get('/insert-coupons', 'App\Http\Controllers\CouponsController@insert_coupons');
Route::get('/unsert-coupons', 'App\Http\Controllers\CouponsController@unset_coupons');
Route::get('/list-coupons', 'App\Http\Controllers\CouponsController@list_coupons');
Route::get('delete-coupons', 'App\Http\Controllers\CouponsController@delete_coupons');
Route::post('/insert-coupons-code', 'App\Http\Controllers\CouponsController@insert_coupons_code');

//check out 
Route::get('/login-checkout', 'App\Http\Controllers\CheckOutController@login_checkout');
Route::get('/logout-checkout', 'App\Http\Controllers\CheckOutController@logout_checkout');
Route::post('/login-customer', 'App\Http\Controllers\CheckOutController@login_customer');
Route::post('/add-customer', 'App\Http\Controllers\CheckOutController@add_customer');
Route::post('/order-place', 'App\Http\Controllers\CheckOutController@order_place');
Route::post('/save-checkout-customer', 'App\Http\Controllers\CheckOutController@save_checkout_customer');
Route::get('/checkout', 'App\Http\Controllers\CheckOutController@checkout');
Route::get('/payment', 'App\Http\Controllers\CheckOutController@payment');

Route::post('/confirm-order', 'App\Http\Controllers\CheckOutController@confirm_order');



Route::post('/select-delivery-home', 'App\Http\Controllers\CheckOutController@select_delivery_home');
Route::post('/fee-shipping', 'App\Http\Controllers\CheckOutController@fee_shipping');
Route::get('/delete-fee', 'App\Http\Controllers\CheckOutController@delete_fee');


//manage order

Route::get('/view-order/{order_code}', 'App\Http\Controllers\OrderController@view_order');
Route::get('/manage-order', 'App\Http\Controllers\OrderController@manage_order');
Route::get('/print-order/{checkout_code}', 'App\Http\Controllers\OrderController@print_order');


// Delivery
Route::get('/delivery', 'App\Http\Controllers\DeliveryController@delivery');

Route::post('/select-delivery', 'App\Http\Controllers\DeliveryController@select_delivery');
Route::post('/insert-delivery', 'App\Http\Controllers\DeliveryController@insert_delivery');
Route::post('/select-feeship', 'App\Http\Controllers\DeliveryController@select_feeship');
Route::post('/update-delivery', 'App\Http\Controllers\DeliveryController@update_delivery');


