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
Route::post('/login/custom', 'LoginController@login')->name('login.custom');

Route::get('/home', 'HomeController@index')->name('home');
Route::group(['middleware' => ['web', 'auth', 'isAdmin']], function(){
	Route::get('logout', 'LoginController@logout')->name('logout.custom');
	Route::get('/admin', function(){
		echo 'yes';
	});
	// Route::get('/admin', 'Admin\DashboardController@index')->name('admin');
	Route::get('/user', 'Member\DashboardController@index')->name('user');
	Route::get('/home', 'HomeController@index')->name('home');
	Route::prefix('admin')->group(function () {
	    Route::resource('roles', 'Admin\RolesController');
	});
});
