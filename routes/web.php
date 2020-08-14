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
    Route::resource('state', 'StateController');
    Route::resource('company', 'CompanyController');
    Route::resource('offer', 'OfferController');
    Route::resource('architect', 'ArchitectController');
    Route::resource('client', 'ClientController');

    Route::get('dump', 'DumpController@run')->name('dump');
    Route::get('deals', 'OfferController@get')->name('deals');
    Route::get('states', 'StateController@getStates')->name('states');

    Route::post('get-companies', 'CompanyController@getCompany')->name('get.company');
    Route::post('get-contacts', 'ClientController@getContact')->name('get.company');
});
