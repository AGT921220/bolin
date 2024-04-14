<?php

Route::post('store/login','StoreController@login');
Route::get('store/storeOpen/{id}','StoreController@storeOpen');
Route::get('store/homepage','StoreController@homepage');
Route::get('store/startRide','StoreController@startRide');
Route::get('store/userInfo/{id}','StoreController@userInfo');
Route::post('store/updateInfo','StoreController@updateInfo');
Route::get('store/lang','ApiController@lang');
Route::post('store/updateLocation','StoreController@updateLocation');
Route::get('store/orderProcess','StoreController@orderProcess');
Route::get('store/getItem','StoreController@getItem');
Route::get('store/changeStatus','StoreController@changeStatus');
Route::post('store/editItem','StoreController@editItem');
Route::get('store/getDboy','StoreController@getDboy');
Route::get('store/getCount','StoreController@getCount');
Route::get('store/plan','StoreController@plan');
Route::post('store/signup','StoreController@signup');
Route::get('store/getLang','ApiController@getLang');
Route::get('store/page','ApiController@page');
Route::get('store/plan','StoreController@plan');
Route::get('store/makeStripePayment','ApiController@makeStripePayment');
Route::get('store/myPlan','StoreController@myPlan');
Route::post('store/renew','StoreController@renew');



Route::resource('store/categories','StoreCategoryController');

?>