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
Route::get('/getSpecies/{syarat}', 'LocationController@getSpecies');


Route::namespace('Dashboard')->prefix('dashboard')->middleware(['auth'])->group(function () {
    Route::get('/', 'HomeController@index')->name('dashboard.home.index');
});

Route::get('submission', 'SubmissionController@index')->name('user.submission.index');
Route::get('submission/createDirect', 'SubmissionController@showDirect')->name('user.submission.showDirect');
Route::post('submission/createDirect', 'SubmissionController@storeDirect')->name('user.submission.storeDirect');

Route::namespace('Admin')->prefix('admin')->middleware(['auth'])->group(function () {
    Route::get('verification', 'UserVerificationController@index')->name('admin.verification.index');
    Route::get('verification/{id}', 'UserVerificationController@show')->name('admin.verification.show');
    Route::get('verification/acc/{id}', 'UserVerificationController@update');
    Route::get('species', 'SpeciesHSController@index')->name('admin.species.index');
    Route::get('species/create', 'SpeciesHSController@create')->name('admin.species.createSpecies');
    Route::post('species/create', 'SpeciesHSController@store')->name('admin.species.storeSpecies');
    Route::get('species/{id}/edit', 'SpeciesHSController@edit')->name('admin.species.editSpecies');
    Route::post('species/{id}/edit', 'SpeciesHSController@update')->name('admin.species.updateSpecies');
    Route::get('species/{id}/delete', 'SpeciesHSController@destroy')->name('admin.species.deleteSpecies');
    Route::get('species/{species_id}/kuota', 'SpeciesHSController@showQuota')->name('admin.species.showquota');
    Route::get('species/{species_id}/create', 'SpeciesHSController@createQuota')->name('admin.species.createquota');
    Route::post('species/{species_id}/create', 'SpeciesHSController@storeQuota')->name('admin.species.storequota');
    Route::get('species/{species_id}/edit/{id}', 'SpeciesHSController@editQuota')->name('admin.species.editquota');
    Route::post('species/{species_id}/edit/{id}', 'SpeciesHSController@updateQuota')->name('admin.species.updatequota');
    Route::get('species/{species_id}/delete/{id}', 'SpeciesHSController@destroyQuota')->name('admin.species.deletequota');
    Route::post('verification/rej/{id}', 'UserVerificationController@updateRej');
    Route::resource('users', 'UserController', ['as' => 'admin']);
    Route::resource('companies', 'CompanyController', ['as' => 'admin']);

    Route::get('species/category','CategoriesController@index')->name('admin.species.category');
    Route::get('species/createCategory','CategoriesController@create')->name('admin.species.createCategory');
    Route::post('species/createCategory', 'CategoriesController@store')->name('admin.species.storeCategory');
    Route::get('species/{id}/editCategory', 'CategoriesController@edit')->name('admin.species.editCategory');
    Route::post('species/{id}/editCategory', 'CategoriesController@update')->name('admin.species.updateCategory');
    Route::get('species/{id}/deleteCategory', 'CategoriesController@destroy')->name('admin.species.deleteSpecies');

});