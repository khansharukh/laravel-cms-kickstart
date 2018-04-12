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

Route::get('/app/sliders', [
    'uses' => 'ApiController@getAppSliders'
]);
Route::get('/products', [
    'uses' => 'ApiController@getProducts'
]);
Route::get('/products/search', [
    'uses' => 'ApiController@searchProducts'
]);
Route::get('/products/{id}', [
    'uses' => 'ApiController@getProduct'
]);
Route::get('/category', [
    'uses' => 'ApiController@getCategory'
]);
Route::get('/category/{id}', [
    'uses' => 'ApiController@getCategoryProducts'
]);
Route::post('/grade/insert', [
    'uses' => 'ApiController@insertGrade'
]);

Route::post('/user/register', [
    'uses' => 'ApiController@registerUser'
]);
Route::post('/user/auth', [
    'uses' => 'ApiController@authUser'
]);
Route::post('/coupon/apply', [
    'uses' => 'ApiController@applyCoupon'
]);

Route::post('/order/create', [
    'uses' => 'ApiController@createOrder'
]);

Route::post('/payment/process', [
    'uses' => 'ApiController@processPayment'
]);
