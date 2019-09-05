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
Route::group(['middleware' => ['web', 'auth', 'isAdmin']], function(){
	Route::get('/admin', 'Admin\DashboardController@index')->name('admin');
	Route::prefix('admin')->group(function () {
	    Route::resource('roles', 'Admin\RoleController');
	    Route::resource('jabatan', 'Admin\JabatanController');
	    Route::resource('users', 'Admin\UserController');
	    // Route::get('user/profile', 'Admin\UserController@profile')->name('users.profile');
	});
});
Route::group(['middleware' => ['web', 'auth']], function(){
	Route::get('/home', 'HomeController@index')->name('home');
	Route::get('logout', 'LoginController@logout')->name('logout.custom');
	Route::get('/member', 'Member\DashboardController@index')->name('member');
	Route::prefix('member')->group(function () {
		Route::get('profile', 'Member\DashboardController@profile')->name('member.profile');
		Route::put('profile', 'Member\DashboardController@profile_update')->name('member.profile_update');
		Route::resource('pertemuan', 'Member\PertemuanController');
		// bendahara
		Route::get('tambah-iuran', 'Member\BendaharaController@create')->name('iuran.create');
		Route::post('tambah-iuran', 'Member\BendaharaController@store')->name('iuran.store');
		Route::get('iuran/{id}', 'Member\BendaharaController@edit')->name('iuran.edit');
		Route::put('iuran/{id}', 'Member\BendaharaController@update')->name('iuran.update');

		// sekretaris
		Route::get('tambah-notulen', 'Member\SekretarisController@create')->name('notulen.create');
		Route::post('tambah-notulen', 'Member\SekretarisController@store')->name('notulen.store');
	});
});