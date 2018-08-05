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

Route::get('/home', 'HomeController@index')->name('home');

Route::get('dashboard', function () {
    return view('admin.dashboard');
});