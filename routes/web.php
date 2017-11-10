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

//PROFILE
Route::get('/profile', 'UserController@index')->name('profile')->middleware(['auth']);

//JQUERY

Route::get('/getProvince/{country}', 'LocationController@getProvince');
Route::get('/getCity/{province}', 'LocationController@getCity');
Route::get('/companyDocument/{id}', 'UserController@downloadCompanyDocument');


Route::namespace('Dashboard')->prefix('dashboard')->middleware(['auth'])->group(function () {
    Route::get('/', 'HomeController@index')->name('dashboard.home.index');

    Route::prefix('admin')->group(function () {

        Route::get('verification', 'AdminUserVerificationController@index')->name('admin.verification.index');
        Route::resource('users', 'AdminUserController', ['as' => 'admin']);
    });
});