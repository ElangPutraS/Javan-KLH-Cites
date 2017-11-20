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
Route::get('/deleteDoc/{type_id}/{company_id}/{document_name}', 'UserController@deleteDocument');


Route::namespace('Dashboard')->prefix('dashboard')->middleware(['auth'])->group(function () {
    Route::get('/', 'HomeController@index')->name('dashboard.home.index');
});

Route::namespace('Admin')->prefix('admin')->middleware(['auth'])->group(function () {
    Route::get('verification', 'UserVerificationController@index')->name('admin.verification.index');
    Route::get('verification/{id}', 'UserVerificationController@show')->name('admin.verification.show');
    Route::get('verification/acc/{id}', 'UserVerificationController@update');
    Route::post('verification/rej/{id}', 'UserVerificationController@updateRej');
    Route::resource('users', 'UserController', ['as' => 'admin']);
    Route::resource('companies', 'CompanyController', ['as' => 'admin']);
});