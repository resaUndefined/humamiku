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

// Route::get('/', function () {
//     return view('welcome');
// });

// move domain from heroku to 000webhost
Route::get('/', function () {
    return Redirect::to('http://humamiku.000webhostapp.com/');
});

Auth::routes();
Route::get('/password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.reset');
Route::post('/password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
Route::get('/password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset.token');
Route::post('/password/reset', 'Auth\ResetPasswordController@reset')->name('password.request');
Route::post('/login/custom', 'LoginController@login')->name('login.custom');
Route::group(['middleware' => ['web', 'auth']], function(){
	Route::get('logout', 'LoginController@logout')->name('logout.custom');
});

Route::group(['middleware' => ['web', 'auth', 'isAdmin']], function(){
	Route::get('/admin', 'Admin\DashboardController@index')->name('admin');
	Route::prefix('admin')->group(function () {
	    Route::resource('roles', 'Admin\RoleController');
	    Route::resource('jabatan', 'Admin\JabatanController');
	    Route::resource('users', 'Admin\UserController');
	});
});
Route::group(['middleware' => ['web', 'auth', 'isMember']], function(){
	Route::get('/home', 'HomeController@index')->name('home');
	Route::get('/member', 'Member\DashboardController@index')->name('member');
	Route::prefix('member')->group(function () {
		Route::get('profile', 'Member\DashboardController@profile')->name('member.profile');
		Route::put('profile', 'Member\DashboardController@profile_update')->name('member.profile_update');
		Route::resource('pertemuan', 'Member\PertemuanController');
		// bendahara
		Route::get('tambah-iuran', 'Member\BendaharaController@create')->name('iuran.create');
		Route::post('tambah-iuran', 'Member\BendaharaController@store')->name('iuran.store');
		Route::get('edit-iuran/{id}', 'Member\BendaharaController@edit')->name('iuran.edit');
		Route::put('edit-iuran/{id}', 'Member\BendaharaController@update')->name('iuran.update');
		Route::get('lihat-iuran/{id}', 'Member\BendaharaController@show')->name('iuran.show');
		Route::get('list-kasflow', 'Member\BendaharaController@kasflow_list')->name('kasflow.list');
		Route::get('kasflow', 'Member\BendaharaController@kasflow_create')->name('kasflow.create');
		Route::post('kasflow', 'Member\BendaharaController@kasflow_store')->name('kasflow.store');
		Route::get('download-kas','Member\BendaharaController@download_kas')->name('download.kas');

		// sekretaris
		Route::get('tambah-notulen', 'Member\SekretarisController@create')->name('notulen.create');
		Route::post('tambah-notulen', 'Member\SekretarisController@store')->name('notulen.store');

		// member
		Route::get('iuranku', 'Member\MemberController@index')->name('iuranku');
		Route::get('kehadiranku', 'Member\MemberController@hadir')->name('kehadiranku');
		Route::get('list-notulen', 'Member\MemberController@list_notulen')->name('notulen.list');
		Route::get('detail-notulen/{id}', 'Member\MemberController@detail_notulen')->name('notulen.show');
		Route::get('list-user', 'Member\MemberController@list_user')->name('list.user');
		Route::get('detail-user/{id}', 'Member\MemberController@detail_user')->name('detail.user');
		Route::get('kehadiran-user', 'Member\MemberController@kehadiran')->name('kehadiran.index');
		Route::get('kehadiran-user/{id}', 'Member\MemberController@kehadiran_show')->name('kehadiran.show');
	});
});

// move domain from heroku to 000webhost
Route::get('/login', function () {
    return Redirect::to('http://humamiku.000webhostapp.com/login');
});