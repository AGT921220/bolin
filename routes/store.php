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
Route::group(['namespace' => 'Store','prefix' => env('store')], function(){

Route::get('/','AdminController@index');
Route::get('login','AdminController@index');
Route::post('login','AdminController@login');

Route::group(['middleware' => 'store'], function(){

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
Route::get('removeImage','AdminController@removeImage');


/*
|-----------------------------
|Manage Store category
|-----------------------------
*/
Route::resource('cate','CateController');
Route::get('cate/delete/{id}','CateController@delete');


/*
|-----------------------------
|Manage Category
|-----------------------------
*/
Route::resource('category','CategoryController');
Route::get('category/delete/{id}','CategoryController@delete');

/*
|-----------------------------
|Manage Items
|-----------------------------
*/
Route::resource('item','ItemController');
Route::get('item/delete/{id}','ItemController@delete');
Route::get('itemStatus','ItemController@itemStatus');
Route::post('addAddon','ItemController@addAddon');
Route::post('inv','ItemController@inv');

/*
|-----------------------------
|Manage Addon Category
|-----------------------------
*/
Route::resource('addonCate','AddonCateController');
Route::get('addonCate/delete/{id}','AddonCateController@delete');

/*
|-----------------------------
|Manage Items
|-----------------------------
*/
Route::resource('addon','AddonController');
Route::get('addon/delete/{id}','AddonController@delete');

/*
|---------------------------------------
|Manage Orders
|---------------------------------------
*/
Route::get('order','OrderController@index');
Route::get('orderStatus','OrderController@status');
Route::post('assign','OrderController@assign');
Route::get('orderView','OrderController@orderView');
Route::get('order/add','OrderController@add');
Route::post('order/add','OrderController@_add');
Route::get('orderEdit','OrderController@orderEdit');
Route::post('orderEdit','OrderController@_orderEdit');

Route::get('report','OrderController@report');
Route::get('getReport','OrderController@_report');
Route::get('user','OrderController@user');

/*
|-----------------------------
|Manage Delivery
|-----------------------------
*/
Route::resource('delivery','DeliveryController');
Route::get('delivery/delete/{id}','DeliveryController@delete');


});
});
