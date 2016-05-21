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
//Route::resource('user', 'UserRest');
Route::post('api/v1/login','UserRest@login');
Route::get('api/v1/logout','UserRest@logout');
Route::post('api/v1/register','Auth\AuthController@mobile_register');

Route::group(['middleware' => ['auth','permissions']], function () {
    Route::get('/', 'HomeController@index');
    Route::group(['roles' => ['shop', 'admin']], function () {
        Route::get('/shop','ShopsController@index')->name("shops");
        Route::get('/shop/create', 'ShopsController@create')->name("createShop");
        Route::post('/shop/store', 'ShopsController@store');
        Route::post('/shop/load_list', 'ShopsController@load_list');
        Route::get('/shop/{user_id}/edit', 'ShopsController@edit')->name("editShop");
        Route::post('/shop/{id}/update', 'ShopsController@update')->name("updateShop");
        Route::post('/shop/check_user_duplicate', 'ShopsController@check_user_duplicate');

        Route::get('/order','OrdersController@index')->name("orders");
        Route::get('/order/create','OrdersController@create')->name("createOrder");
        Route::post('/order/store','OrdersController@store');
        Route::post('/order/load_list', 'OrdersController@load_list');
        


    });
    Route::group(['roles' => ['shipper', 'admin']], function () {
        Route::get('/shipper', 'ShippersController@index')->name("shippers");
        Route::get('/shipper/create', 'ShippersController@create');
        Route::post('/shipper/store', 'ShippersController@store');
        Route::get('/shipper/{shipper_id}/edit','ShippersController@edit');
        Route::post('/shipper/{id}/update','ShippersController@update');
        Route::post('/shipper/load_list','ShippersController@load_list');
        Route::post('/shipper/check_new_user_duplicate', 'ShippersController@check_new_user_duplicate');
        Route::post('/shipper/check_update_user_duplicate', 'ShippersController@check_update_user_duplicate');
    });
});



Route::group(['prefix' => 'api/v1','middleware' => 'auth:api'], function () {
    Route::post('order/{id}', 'OrderRest@update');
    Route::post('find', 'ShipperRest@findByLocation');
    Route::get('shipper/take/{id}','ShipperRest@takeOrder');
    Route::get('order/taken/{id}','OrderRest@getOrderTaken');
    Route::resource('shop', 'ShopRest');
    Route::resource('shipper', 'ShipperRest');
    Route::resource('order', 'OrderRest');
});