<?php

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
//Frontend 
Route::get('/','HomeController@index' );
Route::get('/trang-chu','HomeController@index');
Route::post('/tim-kiem','HomeController@search');

//Danh muc san pham trang chu
Route::get('/danh-muc-san-pham/{slug_category_product}','CategoryProduct@show_category_home');
Route::get('/thuong-hieu-san-pham/{brand_slug}','BrandProduct@show_brand_home');
Route::get('/chi-tiet-san-pham/{product_slug}','ProductController@details_product');

//Backend
Route::get('/admin','AdminController@index');
Route::get('/dashboard','AdminController@show_dashboard');
Route::get('/logout','AdminController@logout');
Route::post('/admin-dashboard','AdminController@dashboard');

//Category Product
Route::get('/add-category-product','CategoryProduct@add_category_product');
Route::get('/edit-category-product/{category_product_id}','CategoryProduct@edit_category_product');
Route::get('/delete-category-product/{category_product_id}','CategoryProduct@delete_category_product');
Route::get('/all-category-product','CategoryProduct@all_category_product');

Route::get('/unactive-category-product/{category_product_id}','CategoryProduct@unactive_category_product');
Route::get('/active-category-product/{category_product_id}','CategoryProduct@active_category_product');


Route::post('/save-category-product','CategoryProduct@save_category_product');
Route::post('/update-category-product/{category_product_id}','CategoryProduct@update_category_product');

//Brand Product
Route::get('/add-brand-product','BrandProduct@add_brand_product');
Route::get('/edit-brand-product/{brand_product_id}','BrandProduct@edit_brand_product');
Route::get('/delete-brand-product/{brand_product_id}','BrandProduct@delete_brand_product');
Route::get('/all-brand-product','BrandProduct@all_brand_product');

Route::get('/unactive-brand-product/{brand_product_id}','BrandProduct@unactive_brand_product');
Route::get('/active-brand-product/{brand_product_id}','BrandProduct@active_brand_product');

Route::post('/save-brand-product','BrandProduct@save_brand_product');
Route::post('/update-brand-product/{brand_product_id}','BrandProduct@update_brand_product');

//Product
Route::get('/add-product','ProductController@add_product');
Route::get('/edit-product/{product_id}','ProductController@edit_product');
Route::get('/delete-product/{product_id}','ProductController@delete_product');
Route::get('/all-product','ProductController@all_product');
Route::post('/Excel','ProductController@ExPort');

Route::get('/unactive-product/{product_id}','ProductController@unactive_product');
Route::get('/active-product/{product_id}','ProductController@active_product');

Route::post('/save-product','ProductController@save_product');
Route::post('/update-product/{product_id}','ProductController@update_product');

Route::post('/add_binhluan','ProductController@add_binhluan');
//khuyenmai
Route::get('/add-KM-product','KMController@addKM_product');
Route::get('/editKM-product/{KM_id}','KMController@editKM_product');
Route::get('/deleteKM-product/{KM_id}','KMController@deleteKM_product');
Route::get('/all-KM-product','KMController@allKM_product');

Route::get('/unactiveKM-product/{KM_id}','KMController@unactiveKM_product');
Route::get('/activeKM-product/{KM_id}','KMController@activeKM_product');

Route::post('/saveKM-product','KMController@saveKM_product');
Route::post('/updateKM-product/{KM_id}','KMController@updateKM_product');

Route::post('/add_binhluan','ProductController@add_binhluan');
//nhan viên
Route::get('/add-NV-product','NvController@addNV_product');
Route::get('/editNV-product/{NV_id}','NvController@editNV_product');
Route::get('/deleteNV-product/{NV_id}','NvController@deleteNV_product');
Route::get('/all-NV-product','NvController@allNV_product');


Route::post('/saveNV-product','NVController@saveNV_product');
Route::post('/updateNV-product/{NV_id}','NVController@updateNV_product');

Route::post('/add_binhluan','ProductController@add_binhluan');
//Cart
Route::post('/update-cart-quantity','CartController@update_cart_quantity');
Route::post('/save-cart','CartController@save_cart');
Route::get('/show-cart','CartController@show_cart');
Route::get('/delete-to-cart/{rowId}','CartController@delete_to_cart');

//Checkout

Route::get('/login-checkout','CheckoutController@login_checkout');
Route::get('/logout-checkout','CheckoutController@logout_checkout');
Route::post('/add-customer','CheckoutController@add_customer');
Route::post('/order-place','CheckoutController@order_place');
Route::post('/login-customer','CheckoutController@login_customer');
Route::get('/checkout','CheckoutController@checkout');
Route::get('/payment','CheckoutController@payment');
Route::post('/save-checkout-customer','CheckoutController@save_checkout_customer');
Route::get('/paypal','CheckoutController@paypal');

//Order
Route::get('/manage-order','CheckoutController@manage_order');
Route::get('/view-order/{orderId}','CheckoutController@view_order');
Route::get('/delete-order/{orderId}','CheckoutController@delete_order');
Route::post('/update-order/{orderId}','CheckoutController@update_order');
Route::get('/print-order/{checkout_code}','CheckoutController@print_order');
// LO
Route::get('/add-lo-product','LoController@addlo_product');
Route::get('/add-detail-lo','LoController@add_detail_lo');
Route::get('/editlo-product/{lo_id}','LoController@editlo_product');
Route::get('/deletelo-product/{lo_id}','LoController@deletelo_product');
Route::get('/all-lo-product','LoController@alllo_product');

Route::get('/unactivelo-product/{lo_id}','LoController@unactivelo_product');
Route::get('/activelo-product/{lo_id}','LoController@activelo_product');

Route::post('/savelo-product','LoController@savelo_product');
Route::post('/updatelo-product/{lo_id}','LoController@updatelo_product');
Route::post('/save-detail-lo','LoController@save_detail_lo');

Route::get('/view-lo/{lo_id}','LoController@view_lo');
//history order
Route::get('/login','historyController@login');
Route::post('/login_history','historyController@login_history');
Route::post('/add_customer','historyController@add_customer');
Route::get('/history','historyController@show_history');
// lien he
Route::get('lienhe', 'HomeController@getContact');

// customer
Route::get('/customer', 'customerController@all_customer');
Route::get('/edit-customer/{id_kh}', 'customerController@edit_customer');
Route::post('/update-customer/{id_kh}','customerController@update_customer');
Route::get('/delete-customer/{id_kh}','customerController@delete_customer');
