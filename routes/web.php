<?php



///////////public routes
Route::get('/home', 'HomeController@index');
Route::get('/', 'HomeController@index');

Route::post('create-zip', 'DocumentController@zip')->name('create-zip');


Auth::routes();


///just admin
Route::middleware(['auth'])->group(function () {

	Route::get('/system/companie', 'CompanieController@index');//show
	Route::post('/system/companie', 'CompanieController@store');//create

	Route::get('/system/companie/{companie}/documents', 'DocumentController@show')->name('system');


	Route::get('/system/user', 'UserController@index');//show
	Route::post('/system/user', 'UserController@store');//show
/*	Route::get('/system/document/load', 'DocumentController@index');
	Route::post('/system/document', 'DocumentController@store');
	Route::delete('/system/document/delete/{id}','DocumentController@destroy');//delete*/


});


///just companies
Route::middleware(['auth'])->group(function () {

	Route::get('/system', 'HomeController@index')->name('system');

	Route::get('/system/companie/{companie}', 'CompanieController@show')->name('system');


	Route::get('/system/document/load', 'DocumentController@index');
	Route::post('/system/document', 'DocumentController@store');
	Route::delete('/system/document/delete/{id}','DocumentController@destroy');//delete

	Route::post('/system/companie', 'CompanieController@store');

});