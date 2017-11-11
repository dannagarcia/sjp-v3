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

Route::get('/', 'DashboardController@index');
Route::resource('/alumni', 'AlumniController');
Route::resource('/event', 'EventController');
Route::post('/event/attend', 'EventController@attend');
Route::post('/event/remove', 'EventController@remove');
Route::get('/reports/test', 'ReportsController@test');

// Reports
Route::get('/reports/alumni', 'ReportsController@reports');
Route::get('/reports/eventreports', 'ReportsController@eventreport');
Route::get('/reports/download-id/{id}', 'ReportsController@downloadId');
