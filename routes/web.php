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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::group(['middleware' => ['web', 'auth']], function () {
    Route::resource('site', 'SiteController');
    Route::post('site/find/', 'SiteController@find')->name('site.find');
    Route::get('site/find/{string}', 'SiteController@find')->name('site.find.get');
    Route::resource('warehouse', 'WarehouseController');
    Route::post('warehouse/find/', 'WarehouseController@find')->name('warehouse.find');
    Route::get('warehouse/find/{string}', 'WarehouseController@find')->name('warehouse.find.get');
    Route::resource('category', 'CategoryController');
    Route::resource('state', 'StateController');
    Route::resource('company', 'CompanyController');
    Route::resource('offer', 'OfferController');
    Route::resource('architect', 'ArchitectController');
    Route::resource('client', 'ClientController');

    Route::get('dump', 'DumpController@run')->name('dump');
    Route::get('deals', 'OfferController@get')->name('deals');
    Route::get('states', 'StateController@getStates')->name('states');

    Route::post('get-companies', 'CompanyController@getCompany')->name('get.company');
    Route::post('get-clients', 'ClientController@getContact')->name('get.clients');
    Route::post('set-offer', 'OfferController@setOffer')->name('set.offer');

    Route::delete('offers', 'OfferController@deleteMany');
    Route::get('offer/get/{id}', 'OfferController@getData')->name('offer.get.data');

    Route::post('company/find/', 'CompanyController@find')->name('company.find');
    Route::get('company/find/{string}', 'CompanyController@find')->name('company.find.get');

    Route::post('client/find/', 'ClientController@find')->name('client.find');
    Route::get('client/find/{string}', 'ClientController@find')->name('client.find.get');

    Route::post('category/find/', 'CategoryController@find')->name('category.find');
    Route::get('category/find/{string}', 'CategoryController@find')->name('category.find.get');
});
