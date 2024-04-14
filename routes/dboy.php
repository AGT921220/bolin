<?php

Route::post('dboy/login','DboyController@login');
Route::get('dboy/homepage','DboyController@homepage');
Route::get('dboy/startRide','DboyController@startRide');
Route::get('dboy/startRide','DboyController@startRide');
Route::get('dboy/userInfo/{id}','DboyController@userInfo');
Route::post('dboy/updateInfo','DboyController@updateInfo');
Route::get('dboy/lang','ApiController@lang');
Route::post('dboy/updateLocation','DboyController@updateLocation');
Route::get('dboy/updateActiveStatus','DboyController@updateActiveStatus');
Route::get('dboy/getAssign','DboyController@getAssign');
Route::post('dboy/recharge','DboyController@recharge');
Route::get('dboy/getCount','DboyController@getCount');
Route::get('dboy/getLang','ApiController@getLang');
Route::get('dboy/page','ApiController@page');
Route::get('dboy/setStatus','DboyController@setStatus');
Route::get('dboy/accept','DboyController@accept');
Route::get('dboy/earn','DboyController@earn');
?>