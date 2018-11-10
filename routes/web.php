<?php

use App\Http\Resources\AlumniCustomFieldsCollection;
use App\AlumniCustomField;

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
Route::get('/event/attend', 'EventController@attend');
Route::post('/event/attend', 'EventController@attend');
Route::resource('/event', 'EventController');
Route::post('/event/remove', 'EventController@remove');
Route::get('/reports/test', 'ReportsController@test');

// Reports
Route::get('/reports/alumni', 'ReportsController@reports');
Route::get('/reports/event_report', 'ReportsController@event_report');
Route::get('/reports/download-id/{id}', 'ReportsController@downloadId');

/**
 * Custom and Settings
 */
Route::get('/settings', 'SettingsController@index');
Route::get('/settings/alumni_custom_fields', 'SettingsController@alumni_custom_fields');
/**
 * APIs
 */
Route::resource('/api/alumni', 'AlumniAPIController');
Route::get('/api/search', 'AlumniAPIController@search');
Route::resource('/api/alumni_custom_fields', 'AlumniCustomFieldsController');
