<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::post('/addon/{id}', 'Api\CartController@addAddOn');
Route::post('/variation/{id}', 'Api\CartController@addVariation');

Route::post('/save-bycash-order', 'Api\OfflineController@store');
Route::get('/cart/{id}', 'Api\CartController@cartDetail');

Route::post('/save-bydelivery-order', 'Api\PaybydeliveryController@store');
Route::get('/payment/notify', 'Api\PaybydeliveryController@notify')->name('api.notify');

Route::get('/checkout', 'Api\ProductController@checkout');
Route::get('/products-lists', 'Api\ProductController@index');
Route::get('/product/{id}', 'Api\ProductController@show');
Route::get('/category-lists', 'Api\FiltercategoryController@index');
Route::post('/add-to-cart/{id}', 'Api\CartController@addToCart')->name('add.cart');
Route::get('/create-session', 'Api\CartController@createSession');
Route::get('/cart-lists', 'Api\CartController@index');
Route::get('increment-cart/{id}', 'Api\CartController@increment');
Route::get('decrement-cart/{id}', 'Api\CartController@decrement');
Route::get('remove-cart/{id}', 'Api\CartController@removeCartItem');
Route::post('clear-cart', 'Api\CartController@clearCarts');
