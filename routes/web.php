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
Route::get('/getDocumentType', 'LocationController@getDocumentReEkspor');


Route::namespace('Dashboard')->prefix('dashboard')->middleware(['auth'])->group(function () {
    Route::get('/', 'HomeController@index')->name('dashboard.home.index');
});

Route::get('submission', 'SubmissionController@index')->name('user.submission.index');
Route::get('submission/{id}/detail', 'SubmissionController@detail')->name('user.submission.detail');
Route::get('submission/{id}/print-satsln', 'SubmissionController@printSatsln')->name('user.submission.printSatsln');
Route::get('submission/create', 'SubmissionController@create')->name('user.submission.create');
Route::post('submission/store', 'SubmissionController@store')->name('user.submission.store');
Route::get('submission/gradually/create', 'SubmissionGraduallyController@create')->name('user.submissionGradually.create');
Route::post('submission/gradually/create', 'SubmissionGraduallyController@store')->name('user.submissionGradually.store');
Route::get('renewal','SubmissionRenewalController@index')->name('user.renewal.index');
Route::get('renewalSubmission/{id}','SubmissionRenewalController@edit')->name('user.renewal.edit');
Route::post('renewalSubmission/{id}', 'SubmissionRenewalController@update')->name('user.renewal.update');


Route::namespace('Admin')->prefix('admin')->middleware(['auth'])->group(function () {
    Route::get('verification', 'UserVerificationController@index')->name('admin.verification.index');
    Route::get('verification/{id}', 'UserVerificationController@show')->name('admin.verification.show');
    Route::get('verification/acc/{id}', 'UserVerificationController@update');
    Route::post('verification/rej/{id}', 'UserVerificationController@updateRej');

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

    Route::resource('users', 'UserController', ['as' => 'admin']);
    Route::resource('companies', 'CompanyController', ['as' => 'admin']);

    Route::get('category','CategoriesController@index')->name('admin.species.category');
    Route::get('category/createCategory','CategoriesController@create')->name('admin.species.createCategory');
    Route::post('category/createCategory', 'CategoriesController@store')->name('admin.species.storeCategory');
    Route::get('category/{id}/editCategory', 'CategoriesController@edit')->name('admin.species.editCategory');
    Route::post('category/{id}/editCategory', 'CategoriesController@update')->name('admin.species.updateCategory');
    Route::get('category/{id}/deleteCategory', 'CategoriesController@destroy')->name('admin.species.deleteSpecies');

    Route::get('verificationSub', 'SubmissionVerificationController@index')->name('admin.verificationSub.index');
    Route::get('verificationSub/{id}/detail', 'SubmissionVerificationController@show')->name('admin.verificationSub.show');
    Route::get('verificationSub/acc/{id}', 'SubmissionVerificationController@update');
    Route::get('verificationSub/rej/{id}', 'SubmissionVerificationController@updateRej');

    Route::get('pnbp','PnbpController@index')->name('admin.pnbp.index');
    Route::get('pnbp/{id}/edit','PnbpController@edit')->name('admin.pnbp.edit');
    Route::post('pnbp/{id}/edit','PnbpController@update')->name('admin.pnbp.update');

    Route::resource('ports', 'PortController', ['as' => 'admin']);
   	Route::resource('news', 'NewsController', ['as' => 'admin']);
    Route::resource('countries', 'CountryController', ['as' => 'admin']);
    Route::resource('cities', 'CityController', ['as' => 'admin']);
    Route::resource('provinces', 'ProvinceController', ['as' => 'admin']);

});

