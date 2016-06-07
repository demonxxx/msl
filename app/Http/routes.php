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
Route::post('api/v1/login', 'UserRest@login');
Route::get('api/v1/logout', 'UserRest@logout');
Route::post('api/v1/register', 'Auth\AuthController@mobile_register');
Route::get('/', function () {
    return view('welcome');
});

Route::group(['middleware' => ['auth', 'permissions']], function () {
    Route::get('/administration', 'HomeController@index');
    Route::group(['roles' => ['shop', 'admin']], function () {
        Route::get('/shop', 'ShopsController@index')->name("shops");
        Route::get('/shop/create', 'ShopsController@create')->name("createShop");
        Route::post('/shop/store', 'ShopsController@store');
        Route::post('/shop/load_list', 'ShopsController@load_list');
        Route::get('/shop/{user_id}/edit', 'ShopsController@edit')->name("editShop");
        Route::post('/shop/{id}/update', 'ShopsController@update')->name("updateShop");
        Route::post('/shop/check_user_duplicate', 'ShopsController@check_user_duplicate');

        Route::get('/order', 'OrdersController@index')->name("orders");
        Route::get('/order/create', 'OrdersController@create')->name("createOrder");
        Route::post('/order/store', 'OrdersController@store');
        Route::post('/order/load_list', 'OrdersController@load_list');
        Route::get('/shipper/notable_list', 'ShippersController@notable_list');
        Route::post('/shipper/load_notable_list', 'ShippersController@load_notable_list');
        Route::get('/shipper/{shipper_id}/{shop_id}/{notable}/notable_shipper', 'ShippersController@notable_shipper');
        Route::post('/shipper/register_shipper', 'ShippersController@register_shipper');
    });
    Route::group(['roles' => ['shipper', 'admin']], function () {
        Route::get('/shipper', 'ShippersController@index')->name("shippers");
        Route::get('/shipper/create', 'ShippersController@create');
        Route::post('/shipper/store', 'ShippersController@store');
        Route::get('/shipper/{shipper_id}/edit', 'ShippersController@edit');
        Route::post('/shipper/{id}/update', 'ShippersController@update');
        Route::post('/shipper/load_list', 'ShippersController@load_list');
        Route::post('/shipper/check_new_user_duplicate', 'ShippersController@check_new_user_duplicate');
        Route::post('/shipper/check_update_user_duplicate', 'ShippersController@check_update_user_duplicate');

        Route::get('/distance_freights', 'DistanceFreightsController@index');
        Route::get('/distance_freights/create', 'DistanceFreightsController@create');
        Route::post('/distance_freights/store', 'DistanceFreightsController@store');
        Route::get('/distance_freights/{dist_freight_id}/edit', 'DistanceFreightsController@edit');
        Route::post('/distance_freights/{dist_freight_id}/update', 'DistanceFreightsController@update');
        Route::get('/distance_freights/{dist_freight_id}/destroy', 'DistanceFreightsController@destroy');
    });
    Route::group(['roles' => ['admin']], function () {
        Route::get('/account', 'AccountsController@index')->name("accounts");
        Route::post('/account/load_list', 'AccountsController@load_list');
        Route::post('/account/update_money', 'AccountsController@update_money');
        Route::get('/admin/settings/administrative_units', 'SettingsController@show_administrative_units');
        Route::get('/admin/settings/administrative_units/{unit_id}/delete', 'SettingsController@delete_administrative_units');
        Route::post('/admin/settings/administrative_units/edit', 'SettingsController@edit_administrative_units');
        Route::post('/admin/settings/administrative_units/add', 'SettingsController@add_administrative_units');
        Route::get('/admin/settings/administrative_units/{unit_id}/get_unit_by_parrent', 'SettingsController@get_unit_by_parrent');
        Route::post('/admin/settings/administrative_units/add_city', 'SettingsController@add_city');
    });


    Route::group(['prefix' => 'admin/settings', 'roles' => ['admin']], function () {
        Route::get('/vehicleTypes', 'SettingsController@showVehicleTypes')->name("vehicle_types");
        Route::post('/vehicleTypes/create', 'SettingsController@createVehicleType');
        Route::post('vehicleTypes/{id}/edit', 'SettingsController@editVehicleType');
        Route::get('/vehicleTypes/{id}/delete', 'SettingsController@deleteVehicleType');

        Route::get('/addedServices', 'SettingsController@showAddedServices')->name("addedServices");
        Route::post('/addedServices/create', 'SettingsController@createAddedService');
        Route::post('/addedServices/{id}/edit', 'SettingsController@editAddedService');
        Route::get('/addedServices/{id}/delete', 'SettingsController@deleteAddedService');

        Route::get('/shopTypes', 'SettingsController@showShopTypes')->name("shopTypes");
        Route::post('/shopTypes/create', 'SettingsController@createShopType');
        Route::post('/shopTypes/{id}/edit', 'SettingsController@editShopType');
        Route::get('/shopTypes/{id}/delete', 'SettingsController@deleteShopType');

        Route::get('/shopScopes', 'SettingsController@showShopScopes')->name("shopScopes");
        Route::post('/shopScopes/create', 'SettingsController@createShopScope');
        Route::post('/shopScopes/{id}/edit', 'SettingsController@editShopScope');
        Route::get('/shopScopes/{id}/delete', 'SettingsController@deleteShopScope');

        Route::get('/shipperTypes', 'SettingsController@showShipperTypes')->name("shipperTypes");
        Route::post('/shipperTypes/create', 'SettingsController@createShipperType');
        Route::post('/shipperTypes/{id}/edit', 'SettingsController@editShipperType');
        Route::get('/shipperTypes/{id}/delete', 'SettingsController@deleteShipperType');

        Route::get('/orderTypes', 'SettingsController@showOrderTypes')->name("orderTypes");
        Route::post('/orderTypes/create', 'SettingsController@createOrderType');
        Route::post('/orderTypes/{id}/edit', 'SettingsController@editOrderType');
        Route::get('/orderTypes/{id}/delete', 'SettingsController@deleteOrderType');
    });
});


Route::group(['prefix' => 'api/v1', 'middleware' => 'auth:api'], function () {

    Route::post('user/changeType', 'UserRest@changeUserType');
    Route::post('user/update/onlineStatus', 'UserRest@updateOnlineStatus');
    Route::get('check/isShipper', 'ShipperRest@isShipper');
    Route::get("user/getMyInfo", "UserRest@getMyInfo");
    Route::get("user/getUserInfo/{id}", "UserRest@getUserInfo");
    Route::post("user/updateMyInfo", "UserRest@updateMyInfo");

    Route::post('shipper/find', 'ShipperRest@findByLocation');
    Route::get('shipper/take/{id}', 'ShipperRest@takeOrder');
    Route::post('shipper/update/status/{id}', 'ShipperRest@updateOrderStatusShipper');
    Route::post('shipper/update/location', 'ShipperRest@updateLocation');
    Route::get('shipper/getTakenOrders/', 'ShipperRest@getTakenOrders');
    Route::get('shipper/deleteOrderHistory/{id}', 'ShipperRest@deleteShipperOrderHistory');

    Route::post('order/{id}', 'OrderRest@update');
    Route::get('order/taken/{id}', 'OrderRest@getOrderTaken');

    Route::get('shop/getOrders', 'ShopRest@getOrders');
    Route::get('shop/deleteOrderHistory/{id}', 'ShopRest@deleteShopOrderHistory');
    Route::post('shop/getShipperLocations', 'ShopRest@getShipperIntoDistance');
    Route::get('shop/shipperLocation/{id}', 'ShopRest@getShipperLocation');

    Route::post("shop/updateBaseFreight/{id}", "OrderRest@freightBaseDistance");
    Route::get("shop/cancelOrder/{id}","ShopRest@cancelOrder");

    Route::resource('shop', 'ShopRest');
    Route::resource('shipper', 'ShipperRest');
    Route::resource('order', 'OrderRest');
});
