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
Route::get('/password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.reset');
Route::post('/password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
Route::get('/password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset.token');
Route::post('/password/reset', 'Auth\ResetPasswordController@reset')->name('password.request');
Route::post('/login/custom', 'LoginController@login')->name('login.custom');
// Route::get('/user', 'Member\DashboardController@index')->name('user');
Route::get('/user', function(){
	echo 'user';
})->name('user');
Route::get('/home', 'HomeController@index')->name('home');
Route::group(['middleware' => ['web', 'auth', 'isAdmin']], function(){
	Route::get('logout', 'LoginController@logout')->name('logout.custom');
	Route::get('/admin', 'Admin\DashboardController@index')->name('admin');
	// Route::get('/admin', 'Admin\DashboardController@index')->name('admin');
	Route::get('/home', 'HomeController@index')->name('home');
	Route::prefix('admin')->group(function () {
	    Route::resource('roles', 'Admin\RoleController');
	    Route::resource('jabatan', 'Admin\JabatanController');
	});
});
