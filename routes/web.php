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
    return redirect()->route('home');
})->name('/');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['middleware' => ['auth']], function () {

	Route::resource('/save-report','ReportController')->names([
        'store'=>'administrator.report.store',
        'create'=>'administrator.report.create',
        'show'=>'administrator.report.show',
        'index'=>'administrator.report.index',
        'destroy'=>'administrator.report.destroy',
    ])->only([
        'store',
        'create',
        'show',
        'index',
        'destroy',
    ]);
});

