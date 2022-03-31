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

Auth::routes();
/* CoreUI templates */



Route::middleware('auth')->group(function() {

	Route::get('/payment', 'UserPaymentController@index')->name('userpayment');

	Route::middleware('user.firm_check')->group(function() {

		Route::get('/', 'Dashboard\DashboardController@index')->name('dashboard');

		Route::prefix('settings')->group(function () {
			Route::get('/', 'Dashboard\SettingsController@index')->name('settings');
			Route::post('/user', 'Dashboard\SettingsController@settings_post')->name('settings.post');
			Route::post('/location', 'Dashboard\SettingsController@location_post')->name('settings.location');
			Route::post('/legal_info', 'Dashboard\SettingsController@legal_info_post')->name('settings.legal_info');
		});

		Route::prefix('cases')->group(function() {
			Route::get('/', 'Dashboard\LegalCaseController@index')->name('legal_cases');
			Route::get('/{uuid}', 'Dashboard\LegalCaseController@single')->name('legal_case.single');
			Route::post('/', 'Dashboard\LegalCaseController@post')->name('legal_cases.post');
			Route::post('/client', 'Dashboard\LegalCaseController@post_client')->name('legal_case.post_client');
			Route::post('/client/location', 'Dashboard\LegalCaseController@post_client_location')->name('legal_case.post_client_location');
			Route::post('/opposing_councel', 'Dashboard\LegalCaseController@post_opposing_councel')->name('legal_case.post_opposing_councel');
		});

		Route::prefix('documents')->group(function() {
            Route::get('/', 'Dashboard\DocumentController@index')->name('documents');
            Route::get('/document-viewer/{id}', 'Dashboard\DocumentController@view_file')->name('documents.view_file');
            Route::post('/file-upload', 'Dashboard\DocumentController@post_file')->name('documents.post');
            Route::post('/file-create', 'Dashboard\DocumentController@post_wysiwyg_document')->name('documents.create');
            Route::post('/folder-create', 'Dashboard\DocumentController@post_folder')->name('documents.post_folder');
        });
        
        Route::prefix('clients')->group(function() {
            Route::get('/', 'Dashboard\ClientController@index')->name('clients');
            Route::get('/{uuid}', 'Dashboard\ClientController@single')->name('client');
        });
	
	});

	Route::prefix('firm')->group(function () {
		Route::get('/', 'Dashboard\FirmController@index')->name('firm');
		Route::post('/', 'Dashboard\FirmController@post')->name('firm.post');

		Route::get('/stripe/create', 'Dashboard\FirmController@stripe_account_create')->name('firm.stripe_create');
		Route::get('/stripe/redirect', 'Dashboard\FirmController@stripe_return');

	});





	// Section CoreUI elements
	Route::view('/sample/dashboard','samples.dashboard');
	Route::view('/sample/buttons','samples.buttons');
	Route::view('/sample/social','samples.social');
	Route::view('/sample/cards','samples.cards');
	Route::view('/sample/forms','samples.forms');
	Route::view('/sample/modals','samples.modals');
	Route::view('/sample/switches','samples.switches');
	Route::view('/sample/tables','samples.tables');
	Route::view('/sample/tabs','samples.tabs');
	Route::view('/sample/icons-font-awesome', 'samples.font-awesome-icons');
	Route::view('/sample/icons-simple-line', 'samples.simple-line-icons');
	Route::view('/sample/widgets','samples.widgets');
	Route::view('/sample/charts','samples.charts');
});
// Section Pages
Route::view('/sample/error404','errors.404')->name('error404');
Route::view('/sample/error500','errors.500')->name('error500');