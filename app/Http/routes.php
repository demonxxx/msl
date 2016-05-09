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
//Route::group(['middleware' => ['admin']], function () {
//
//});
// });

Route::group(['middleware' => 'auth'], function () {
    Route::get('/', 'HomeController@index');
    Route::get('/shop', 'ShopsController@index')->name("shops");
    Route::get('/shop/create', 'ShopsController@create');
    Route::post('/shop/store', 'ShopsController@store');
    Route::post('/shop/load_list', 'ShopsController@load_list');
    Route::get('/shop/{user_id}/edit', 'ShopsController@edit');
    Route::post('/shop/{id}/update', 'ShopsController@update');
    Route::post('/shop/check_user_duplicate','ShopsController@check_user_duplicate');
});


Route::group(['prefix' => 'api/v1', 'middleware' => 'auth:api'], function () {
    Route::resource('user', 'UserRest');
    Route::resource('shop', 'ShopRest');
    Route::resource('shipper', 'ShipperRest');
    Route::resource('order', 'OrderRest');
});