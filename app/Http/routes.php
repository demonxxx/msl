<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

use Illuminate\Http\Request;
Route::auth();
// Route::group(['middleware' => 'web'], function () {
	Route::group(['middleware' => 'auth'], function () {
		Route::get('/', 'HomeController@index');
		Route::resource('shop', 'ShopController');
		Route::resource('order', 'OrderController');
		Route::resource('shipper', 'ShipperController');
		Route::get('/shop', 'ShopsController@index');
		Route::get('/shop/create', 'ShopsController@create');
		Route::post('/shop/store', 'ShopsController@store');
	});
// });


