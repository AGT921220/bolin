<?php

use Illuminate\Support\Facades\Artisan;

include("store.php");
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

Route::get('/clear-cache', function () {
    Artisan::call('cache:clear');
    Artisan::call('config:clear');
    Artisan::call('view:clear');
    return "Caché limpiada.";
});

Route::get('/','AdminController@index');
Route::get('login','AdminController@index')->name('login');
// Route::post('login','AdminController@login');
Route::post('/login', 'AdminController@login')->name('login_post');

Route::group(['middleware' => 'auth'], function(){

/*
|-----------------------------------------
|Dashboard and Account Setting & Logout
|-----------------------------------------
*/
Route::get('home','AdminController@home');
Route::get('setting','AdminController@setting');
Route::post('setting','AdminController@update');
Route::get('logout','AdminController@logout');
Route::get('setLang','AdminController@setLang');
Route::resource('deposits','DepositController')->only(['index']);

/*
|-----------------------------
|Manage Language
|-----------------------------
*/
Route::resource('language','LanguageController');
Route::get('language/delete/{id}','LanguageController@delete');


/*
|-----------------------------
|Manage Store
|-----------------------------
*/
Route::resource('store','StoreController');
Route::get('store/delete/{id}','StoreController@delete');
Route::get('removeImage','StoreController@removeImage');
Route::get('storeAction','StoreController@storeAction');
Route::get('loginAsStore','StoreController@loginAsStore');
Route::get('qr','StoreController@qr');
Route::post('storePlan','StoreController@storePlan');
Route::get('pay','StoreController@pay');

/*
|-----------------------------
|Manage Store category
|-----------------------------
*/
Route::resource('cate','CateController');
Route::get('cate/delete/{id}','CateController@delete');

/*
|-----------------------------
|Manage Slider
|-----------------------------
*/
Route::resource('slider','SliderController');
Route::get('slider/delete/{id}','SliderController@delete');
Route::get('slider/status/{id}','SliderController@status');

/*
|-----------------------------
|Manage Plans
|-----------------------------
*/
Route::resource('plan','PlanController');
Route::get('plan/delete/{id}','PlanController@delete');
Route::get('plan/status/{id}','PlanController@status');
Route::get('fiance','PlanController@fiance');
Route::get('sendAlert','PlanController@sendAlert');

/*
|-----------------------------
|Manage Delivery
|-----------------------------
*/
Route::resource('delivery','DeliveryController');
Route::get('delivery/delete/{id}','DeliveryController@delete');

/*
|-----------------------------
|Manage Coupon
|-----------------------------
*/
Route::resource('offer','OfferController');
Route::get('offer/delete/{id}','OfferController@delete');

/*
|-----------------------------
|Manage App Pages
|-----------------------------
*/
Route::get('page','PageController@index');
Route::post('page','PageController@_save');


/*
|---------------------------------------
|Manage Push Notification & Reporting
|---------------------------------------
*/
Route::get('push','PushController@index');
Route::post('send','PushController@send');
Route::get('report','PushController@report');
Route::get('getReport','PushController@_report');

/*
|---------------------------------------
|Manage App Text
|---------------------------------------
*/
Route::get('text','TextController@index');
Route::post('text','TextController@save');

/*
|---------------------------------------
|Manage Orders
|---------------------------------------
*/
Route::get('order','OrderController@index');
Route::get('orderStatus','OrderController@status');
Route::post('assign','OrderController@assign');
Route::get('orderView','OrderController@orderView');

/*
|-------------------------------------
|App Users
|-------------------------------------
*/
Route::get('appUser','AppUserController@index');
Route::post('updateWallet','AppUserController@updateWallet');


});
