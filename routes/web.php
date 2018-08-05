<?php








///////////public routes
Route::get('/', function () {
    return view('public.index');
});

/*Route::get('/loginn', function () {
    return view('public.login');
});
*/
Route::get('/laravel', function () {
    return view('welcome');
});


Auth::routes();

Route::get('/system', 'HomeController@index')->name('system');


Route::get('/system/document/load', 'DocumentController@index');
Route::post('/system/document', 'DocumentController@store');

