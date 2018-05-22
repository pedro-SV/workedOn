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

//Route::get('/', function () {
//    return view('welcome');
//});

Route::get('/', 'HomepageController@index')->name('homepage');
Route::get('/test', 'HomepageController@test');
Route::get('/import', 'TicketController@importForm')->name('import.form');
Route::post('/import', 'TicketController@importRun')->name('import.run');
Route::get('/report', 'ReportController@reportForm')->name('report.form');
Route::post('/report', 'ReportController@reportRun')->name('report.run');