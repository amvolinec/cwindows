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

Route::get('/settings', 'SettingController@get')->name('settings.get');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::group(['middleware' => ['web', 'auth']], function () {
    Route::resource('currency', 'CurrencyController');
    Route::post('currency/find/', 'CurrencyController@find')->name('currency.find');
    Route::get('currency/find/{string}', 'CurrencyController@find')->name('currency.find.get');
    Route::resource('setting', 'SettingController');
    Route::post('setting/find/', 'SettingController@find')->name('setting.find');
    Route::get('setting/find/{string}', 'SettingController@find')->name('setting.find.get');
    Route::resource('tender', 'TenderController');
    Route::post('tender/find/', 'TenderController@find')->name('tender.find');
    Route::get('tender/find/{string}', 'TenderController@find')->name('tender.find.get');
    Route::resource('transaction', 'TransactionController');
    Route::post('transaction/find/', 'TransactionController@find')->name('transaction.find');
    Route::get('transaction/find/{string}', 'TransactionController@find')->name('transaction.find.get');
    Route::resource('transactiontype', 'TransactionTypeController');
    Route::post('transactiontype/find/', 'TransactionTypeController@find')->name('transactiontype.find');
    Route::get('transactiontype/find/{string}', 'TransactionTypeController@find')->name('transactiontype.find.get');


    Route::resource('material', 'MaterialController');
    Route::post('material/find/', 'MaterialController@find')->name('material.find');
    Route::get('material/find/{string}', 'MaterialController@find')->name('material.find.get');
    Route::get('materials-get', 'MaterialController@get')->name('material.get');
    Route::post('materials-search', 'MaterialController@search')->name('material.search');


    Route::resource('color', 'ColorController');
    Route::post('color/find/', 'ColorController@find')->name('color.find');
    Route::get('color/find/{string}', 'ColorController@find')->name('color.find.get');
    Route::get('colors-get', 'ColorController@get')->name('colors.get');
    Route::post('colors-search', 'ColorController@search')->name('colors.search');

    Route::resource('service', 'ServiceController');
    Route::post('service/find/', 'ServiceController@find')->name('service.find');
    Route::get('service/find/{string}', 'ServiceController@find')->name('service.find.get');

    Route::resource('persontype', 'PersonTypeController');
    Route::post('persontype/find/', 'PersonTypeController@find')->name('persontype.find');
    Route::get('persontype/find/{string}', 'PersonTypeController@find')->name('persontype.find.get');

    Route::resource('personoffer', 'PersonToOfferController');
    Route::post('personoffer/find/', 'PersonToOfferController@find')->name('personoffer.find');
    Route::get('personoffer/find/{string}', 'PersonToOfferController@find')->name('personoffer.find.get');

    Route::resource('person', 'PersonController');
    Route::post('person/find/', 'PersonController@find')->name('person.find');
    Route::get('person/find/{string}', 'PersonController@find')->name('person.find.get');

    Route::post('company/find/', 'CompanyController@find')->name('company.find');
    Route::get('company/find/{string}', 'CompanyController@find')->name('company.find.get');
    Route::resource('company', 'CompanyController');

    Route::resource('file', 'FileController');
    Route::post('file/find/', 'FileController@find')->name('file.find');
    Route::get('file/find/{string}', 'FileController@find')->name('file.find.get');
    Route::delete('files', 'FileController@deleteMany');

    Route::resource('maintenance', 'MaintenanceController');
    Route::post('maintenance/find/', 'MaintenanceController@find')->name('maintenance.find');
    Route::get('maintenance/find/{string}', 'MaintenanceController@find')->name('maintenance.find.get');


    Route::resource('profile', 'ProfileController');
    Route::post('profile/find/', 'ProfileController@find')->name('profile.find');
    Route::get('profile/find/{string}', 'ProfileController@find')->name('profile.find.get');
    Route::get('profiles-get', 'ProfileController@get')->name('profile.get');
    Route::post('profiles-search', 'ProfileController@search')->name('profile.search');


    Route::resource('user', 'UserController');
    Route::post('user/find/', 'UserController@find')->name('user.find');
    Route::get('user/find/{string}', 'UserController@find')->name('user.find.get');

    Route::resource('site', 'SiteController');
    Route::post('site/find/', 'SiteController@find')->name('site.find');
    Route::get('site/find/{string}', 'SiteController@find')->name('site.find.get');
    Route::resource('warehouse', 'WarehouseController');
    Route::post('warehouse/find/', 'WarehouseController@find')->name('warehouse.find');
    Route::get('warehouse/find/{string}', 'WarehouseController@find')->name('warehouse.find.get');
    Route::resource('category', 'CategoryController');
    Route::resource('state', 'StateController');
    Route::resource('offer', 'OfferController');
    Route::resource('architect', 'ArchitectController');
    Route::resource('client', 'ClientController');

    Route::get('dump', 'DumpController@run')->name('dump');
    Route::get('deals', 'OfferController@get')->name('deals');
    Route::get('states', 'StateController@getStates')->name('states');
    Route::get('create-offer', 'OfferController@createOffer')->name('offer.create.new');

    Route::post('get-companies', 'CompanyController@getCompany')->name('get.company');
    Route::post('get-clients', 'ClientController@getContact')->name('get.clients');
    Route::post('set-offer', 'OfferController@setOffer')->name('set.offer');
    Route::post('update-offer', 'OfferController@updateOffer')->name('update.offer');

    Route::delete('offers', 'OfferController@deleteMany');
    Route::get('offer/get/{id}', 'OfferController@getData')->name('offer.get.data');
    Route::get('offer/print/{id}/{lang}', 'OfferController@tenderPrint')->name('offer.print');
    Route::get('offer/preview/{id}/{lang}', 'OfferController@preview')->name('offer.preview');
    Route::get('offer/create-tender/{id}', 'OfferController@createTender')->name('offer.create.tender');

    Route::get('tender/{id}/make', 'TenderController@makeVersion')->name('tender.make');
    Route::get('tender/{id}/set', 'TenderController@set')->name('tender.set');
    Route::post('delete-tender', 'TenderController@deleteTender')->name('tender.nope');


    Route::post('client/find/', 'ClientController@find')->name('client.find');
    Route::get('client/find/{string}', 'ClientController@find')->name('client.find.get');
    Route::post('contact-add', 'ClientController@add')->name('client.add');

    Route::post('category/find/', 'CategoryController@find')->name('category.find');
    Route::get('category/find/{string}', 'CategoryController@find')->name('category.find.get');

    Route::delete('position', 'PositionController@delete');

    Route::get('event', 'EventController@index')->name('event.index');
    Route::get('event/{id}', 'EventController@show')->name('event.show');
    Route::post('event/{id}', 'EventController@clear')->name('event.clear');
    Route::post('event/find/', 'EventController@find')->name('event.find');
    Route::get('event/find/{string}', 'EventController@find')->name('event.find.get');
});

Route::middleware(['web', 'auth', 'super-admin'])->group(function () {

});


