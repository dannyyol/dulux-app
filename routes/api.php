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
// Colour Management
// Route::get('/see-all-colours/{id}', 'Api\ColourpaletteController@allColours');

Route::post('/product-colour/store',
'Admin\ProductcolourController@store')->name('admin.productcolour.store');

Route::get('colour-stage-1/{paletteId}', 'Api\ProductcolourController@colourStage1');
Route::get('colour-stage-2/{paletteId}', 'Api\ProductcolourController@colourStage2');

Route::post('pcategory-list/', 'Api\PcategoryController@listCategory');
Route::post('pcategory/subcategory/{id}', 'Api\PcategoryController@getSubcategory');

Route::get('/colour/products/{id}', 'Api\ProductcolourController@show');

Route::get('/see-all-colour/{id}', 'Api\ProductcolourController@seeAllColour');

Route::get('/count-popular/{id}', 'Api\ProductcolourController@countPopular');

Route::get('/count-all/{id}', 'Api\ProductcolourController@allColourCount');

Route::post('/colour-categories/{id}', 'Api\ColourpaletteController@show');
// Route::post('/colour-categories-white/{id}', 'Api\ColourpaletteController@getWhite');

// Route::get('/product-category/{id}', 'Api\ColourCategoryController@getProductCategory');

Route::get('/colour-palette', 'Api\ColourpaletteController@index');

Route::post('filter-product-colour/{paletteId}/{catId}', 'Api\ProductcolourController@filterProductColour');

Route::post('filter-product/{pcatId}/{catId}/{cId}', 'Api\ProductController@filterProduct');

Route::post('category-products/{id}', 'Api\PcategoryController@productCategory');

Route::get('/products-lists', 'Api\ProductController@index');


Route::post('/add-product/{id}', 'Api\CartController@addProduct');

Route::post('/addon/{id}', 'Api\CartController@addAddOn');
Route::post('/variation/{id}', 'Api\CartController@addVariation');

Route::post('/save-bycash-order/{id}', 'Api\OfflineController@store');
Route::get('/cart/{id}', 'Api\CartController@cartDetail');

Route::post('/save-bydelivery-order', 'Api\PaybydeliveryController@store');
Route::get('/payment/notify', 'Api\PaybydeliveryController@notify')->name('api.notify');

Route::get('/checkout', 'Api\ProductController@checkout');
Route::get('/product/{id}', 'Api\ProductController@show');
Route::get('/category-lists', 'Api\PcategoryController@index');

Route::get('/category-lists/{id}', 'Api\ColourpaletteController@getFilterCategory');
Route::post('/add-to-cart/{id}', 'Api\CartController@addToCart')->name('add.cart');
Route::get('/create-session', 'Api\CartController@createSession');
Route::get('/cart-lists', 'Api\CartController@index');
Route::get('increment-cart/{id}', 'Api\CartController@increment');
Route::get('decrement-cart/{id}', 'Api\CartController@decrement');
Route::get('remove-cart/{id}', 'Api\CartController@removeCartItem');
Route::post('clear-cart', 'Api\CartController@clearCarts');
