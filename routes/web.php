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
    $news = \App\News::orderBy('created_at', 'desc')->limit(6)->get();

    return view('welcome3', compact('news'));
});

Route::get('/news/{id}', function ($id) {
    $news = \App\News::findOrFail($id);
    $newsNext = \App\News::where('created_at', '>', $news->created_at)->orderBy('created_at', 'asc')->first();
    $newsPrev = \App\News::where('created_at', '<', $news->created_at)->orderBy('created_at', 'desc')->first();

    return view('news-view', compact('news', 'newsNext', 'newsPrev'));
});

Auth::routes();

//PROFILE
Route::get('/profile', 'UserController@index')->name('profile')->middleware(['auth']);
Route::get('/profile/edit', 'UserController@edit')->name('profile.edit')->middleware(['auth']);
Route::post('/profile/{id}/edit', 'UserController@update')->name('profile.update')->middleware(['auth']);
Route::post('/profile/{id}/editAdmin', 'UserController@updateAdmin')->name('profile.update.admin')->middleware(['auth']);

//JQUERY

Route::get('/getProvince/{country}', 'LocationController@getProvince');
Route::get('/getCity/{province}', 'LocationController@getCity');
Route::get('/companyDocument/{id}', 'UserController@downloadCompanyDocument');
Route::get('/deleteDoc/{type_id}/{company_id}/{document_name}', 'UserController@deleteDocument');
Route::get('/getSpecies/{appendix_type}/{category_id}/{source_id}', 'LocationController@getSpecies');
Route::get('/getSpeciesComodity/{comodity}', 'LocationController@getSpeciesComodity');
Route::get('/getDocumentType/{id}', 'LocationController@getDocument');
Route::get('/getKuotaNasional/{species_id}/{year}', 'LocationController@getKuotaNasional');
Route::get('/notif/read/{id}', 'LocationController@markReadNotif');


Route::namespace('Dashboard')->prefix('dashboard')->middleware(['auth'])->group(function () {
    Route::get('/', 'HomeController@index')->name('dashboard.home.index');
});

Route::get('submission', 'SubmissionController@index')->name('user.submission.index')->middleware(['auth', 'can:access-pelaku-usaha']);
Route::get('submission/{id}/detail', 'SubmissionController@detail')->name('user.submission.detail')->middleware(['auth', 'can:access-pelaku-usaha']);
Route::get('submission/create', 'SubmissionController@create')->name('user.submission.create')->middleware(['auth', 'can:access-pelaku-usaha']);
Route::post('submission/store', 'SubmissionController@store')->name('user.submission.store')->middleware(['auth', 'can:access-pelaku-usaha']);

Route::get('submission/gradually/create', 'SubmissionGraduallyController@create')->name('user.submissionGradually.create')->middleware(['auth', 'can:access-pelaku-usaha']);
Route::post('submission/gradually/create', 'SubmissionGraduallyController@store')->name('user.submissionGradually.store')->middleware(['auth', 'can:access-pelaku-usaha']);
Route::get('submission/gradually/{id}/print-satsln', 'SubmissionGraduallyController@printSatsln')->name('user.submissionGradually.printSatsln')->middleware(['auth', 'can:access-pelaku-usaha']);
Route::get('renewal','SubmissionRenewalController@index')->name('user.renewal.index')->middleware(['auth', 'can:access-pelaku-usaha']);
Route::get('renewalSubmission/{id}','SubmissionRenewalController@edit')->name('user.renewal.edit')->middleware(['auth', 'can:access-pelaku-usaha']);
Route::post('renewalSubmission/{id}', 'SubmissionRenewalController@update')->name('user.renewal.update')->middleware(['auth', 'can:access-pelaku-usaha']);

Route::get('invoice', 'InvoiceController@index')->name('user.invoice.index')->middleware(['auth', 'can:access-pelaku-usaha']);
Route::get('invoice/{id}/detail', 'InvoiceController@show')->name('user.invoice.detail')->middleware(['auth', 'can:access-pelaku-usaha']);

Route::get('companyQuota/', 'CompanyQuotaController@index')->name('user.companyQuota.index')->middleware(['auth', 'can:access-pelaku-usaha']);


Route::namespace('Admin')->prefix('admin')->middleware(['auth', 'can:access-super-n-admin'])->group(function () {
    Route::get('verification', 'UserVerificationController@index')->name('admin.verification.index');
    Route::get('verification/{id}', 'UserVerificationController@show')->name('admin.verification.show');
    Route::get('verification/acc/{id}', 'UserVerificationController@update');
    Route::post('verification/rej', 'UserVerificationController@updateRej');

    Route::get('species', 'SpeciesHSController@index')->name('admin.species.index');
    Route::get('species/create', 'SpeciesHSController@create')->name('admin.species.createSpecies');
    Route::post('species/create', 'SpeciesHSController@store')->name('admin.species.storeSpecies');
    Route::get('species/{id}/edit', 'SpeciesHSController@edit')->name('admin.species.editSpecies');
    Route::post('species/{id}/edit', 'SpeciesHSController@update')->name('admin.species.updateSpecies');
    Route::get('species/{id}/delete', 'SpeciesHSController@destroy')->name('admin.species.deleteSpecies');
    Route::get('species/{species_id}/kuota', 'SpeciesHSController@showQuota')->name('admin.species.showquota');
    Route::get('species/{species_id}/create', 'SpeciesHSController@createQuota')->name('admin.species.createquota');
    Route::post('species/{species_id}/create', 'SpeciesHSController@storeQuota')->name('admin.species.storequota');
    Route::get('species/{species_id}/plus/{id}', 'SpeciesHSController@editQuota')->name('admin.species.plusquota');
    Route::get('species/{species_id}/minus/{id}', 'SpeciesHSController@editQuota')->name('admin.species.minusquota');
    Route::post('species/{species_id}/edit/{id}', 'SpeciesHSController@updateQuota')->name('admin.species.updatequota');
    Route::get('species/{species_id}/delete/{id}', 'SpeciesHSController@destroyQuota')->name('admin.species.deletequota');
    Route::get('species/{id}/detail', 'SpeciesHSController@detail')->name('admin.species.detail');

    Route::resource('users', 'UserController', ['as' => 'admin']);
    Route::resource('companies', 'CompanyController', ['as' => 'admin']);

    Route::get('category', 'CategoriesController@index')->name('admin.species.category');
    Route::get('category/createCategory', 'CategoriesController@create')->name('admin.species.createCategory');
    Route::post('category/createCategory', 'CategoriesController@store')->name('admin.species.storeCategory');
    Route::get('category/{id}/editCategory', 'CategoriesController@edit')->name('admin.species.editCategory');
    Route::post('category/{id}/editCategory', 'CategoriesController@update')->name('admin.species.updateCategory');
    Route::get('category/{id}/deleteCategory', 'CategoriesController@destroy')->name('admin.species.deleteSpecies');

    Route::get('verificationSub', 'SubmissionVerificationController@index')->name('admin.verificationSub.index');
    Route::get('verificationSub/{id}/detail', 'SubmissionVerificationController@show')->name('admin.verificationSub.show');
    Route::get('verificationSub/acc/{id}/{period}', 'SubmissionVerificationController@update');
    Route::post('verificationSub/rej/{id}', 'SubmissionVerificationController@updateRej');


    Route::get('verificationRen', 'SubmissionVerificationController@indexRen')->name('admin.verificationRen.index');
    Route::get('verificationRen/{id}/detail', 'SubmissionVerificationController@showRen')->name('admin.verificationRen.show');
    Route::post('verificationRen/acc/{id}', 'SubmissionVerificationController@updateRen')->name('admin.verificationRen.acc');
    Route::post('verificationRen/rej/{id}', 'SubmissionVerificationController@updateRejectRen');

    Route::post('verification/rej/{id}', 'SubmissionVerificationController@updateRejection');

    Route::get('pnbp', 'PnbpController@index')->name('admin.pnbp.index');
    Route::get('pnbp/{id}/show', 'PnbpController@show')->name('admin.pnbp.create');
    Route::post('pnbp/{id}/store', 'PnbpController@store')->name('admin.pnbp.store');
    Route::get('pnbp/{id}/payment', 'PnbpController@showPayment')->name('admin.pnbp.payment');
    Route::post('pnbp/{id}/storePayment', 'PnbpController@storePayment')->name('admin.pnbp.storePayment');

    Route::resource('ports', 'PortController', ['as' => 'admin']);
    Route::resource('news', 'NewsController', ['as' => 'admin']);
    Route::resource('countries', 'CountryController', ['as' => 'admin']);
    Route::resource('cities', 'CityController', ['as' => 'admin']);
    Route::resource('provinces', 'ProvinceController', ['as' => 'admin']);
    Route::resource('purposeType', 'PurposeTypeController', ['as' => 'admin']);
    Route::resource('typeIdentify', 'TypeIdentifyController', ['as' => 'admin']);
    Route::resource('speciesSex', 'SpeciesSexController', ['as' => 'admin']);


    Route::get('user','UserRoleController@index')->name('superadmin.index');
    Route::get('user/{id}/delete','UserRoleController@destroy')->name('superadmin.deleteUser');
    Route::get('user/{id}/restore','UserRoleController@restore')->name('superadmin.restoreUser');
    Route::get('user/{id}/edit','UserRoleController@edit')->name('superadmin.editUser');
    Route::post('user/{id}/edit','UserRoleController@update')->name('superadmin.updateUser');
    Route::get('user/create','UserRoleController@create')->name('superadmin.createUser');
    Route::post('user/create','UserRoleController@store')->name('superadmin.storeUser');

    Route::get('appendix', 'AppendixSourceController@index')->name('admin.appendix.index');

    Route::get('source', 'SourceController@index')->name('admin.source.index');

    Route::get('unit', 'UnitController@index')->name('admin.unit.index');

    Route::get('reportPnbp', 'ReportController@reportPnbp')->name('admin.report.pnbp');
    Route::get('printReportPnbp/{m?}/{y?}', 'ReportController@printReportPnbp')->name('admin.report.printReportPnbp');
    Route::get('reportSatsln', 'ReportController@reportSatsln')->name('admin.report.satsln');
    Route::get('printReportSatsln/{m?}/{y?}', 'ReportController@printReportSatsln')->name('admin.report.printReportSatsln');
    Route::get('printReportDetailSatsln/{id}', 'ReportController@printReportDetailSatsln')->name('admin.report.printReportDetailSatsln');
    Route::get('portal-insw', 'ReportController@portalInsw')->name('admin.report.portalInsw');
    Route::get('send-insw/{tradePermitId}', 'ReportController@sendInsw')->name('admin.report.sendInsw');
    Route::get('print-satsln/{id}', 'ReportController@printSatsln')->name('admin.report.printSatsln');
    Route::post('store-stamp-satsln', 'ReportController@storeStampSatsln')->name('admin.report.storeStampSatsln');
    Route::post('store-is-printed', 'ReportController@storeIsPrinted')->name('admin.report.storeIsPrinted');
    Route::get('reportInvestation', 'ReportController@companyInvestation')->name('admin.report.investation');
    Route::get('printReportInvestation', 'ReportController@printReportInvestation')->name('admin.report.printReportInvestation');
    Route::get('reportLabor', 'ReportController@companyLabor')->name('admin.report.labor');
    Route::get('printReportLabor', 'ReportController@printReportLabor')->name('admin.report.printReportLabor');
    Route::get('reportForeignExchange', 'ReportController@reportForeignExchange')->name('admin.report.foreignExchange');
    Route::get('printReportForeignExchange', 'ReportController@printReportForeignExchange')->name('admin.report.printReportForeignExchange');

    Route::get('companyQuota', 'CompanyQuotaController@index')->name('admin.companyQuota.index');
    Route::get('companyQuota/{id}/detail', 'CompanyQuotaController@detail')->name('admin.companyQuota.detail');
    Route::get('companyQuota/{id}/show', 'CompanyQuotaController@show')->name('admin.companyQuota.create');
    Route::post('companyQuota/{id}/store', 'CompanyQuotaController@store')->name('admin.companyQuota.store');
    Route::get('companyQuota/{company_id}/edit/{id}', 'CompanyQuotaController@edit')->name('admin.companyQuota.edit');
    Route::post('companyQuota/{company_id}/update/{id}', 'CompanyQuotaController@update')->name('admin.companyQuota.update');
    Route::get('companyQuota/{company_id}/delete/{pivot_id}', 'CompanyQuotaController@destroy')->name('admin.companyQuota.delete');

    Route::resource('percentage', 'PercentageController', ['as' => 'admin']);
});