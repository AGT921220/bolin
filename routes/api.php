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

Route::group(array('namespace' => 'Api'), function () {

Route::get('homepage','ApiController@homepage');
Route::get('page','ApiController@page');
Route::get('makeStripePayment','ApiController@makeStripePayment');
Route::get('getLang','ApiController@getLang');
Route::get('city','ApiController@city');
Route::get('item','ApiController@item');
Route::post('addToCart','ApiController@addToCart');
Route::get('cartCount','ApiController@cartCount');
Route::get('updateCart/{id}/{type}','ApiController@updateCart');
Route::get('getCart/{cartNo}','ApiController@getCart');
Route::get('getOffer/{cartNo}','ApiController@getOffer');
Route::get('applyCoupen/{id}/{cartNo}','ApiController@applyCoupen');
Route::get('removeOffer/{id}/{cartNo}','ApiController@removeOffer');
Route::post('order','ApiController@order');
Route::get('my','ApiController@my');
Route::post('login','ApiController@login');
Route::post('signup','ApiController@signup');
Route::post('forgot','ApiController@forgot');
Route::post('verify','ApiController@verify');
Route::post('updatePassword','ApiController@updatePassword');
Route::get('userInfo','ApiController@userInfo');
Route::post('saveAddress','ApiController@saveAddress');
Route::get('cancelOrder','ApiController@cancelOrder');
Route::post('rating','ApiController@rating');
Route::post('updateInfo','ApiController@updateInfo');
Route::get('runningOrder','ApiController@runningOrder');
Route::get('orderDetail','ApiController@orderDetail');
Route::get('getSearch','ApiController@getSearch');
Route::get('payStack','ApiController@payStack');
Route::get('payStackSuccess','ApiController@payStackSuccess');
Route::get('payStackCancel','ApiController@payStackCancel');

include('dboy.php');
include('store_api.php');

});
