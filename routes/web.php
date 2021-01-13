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


Route::get('/', 'HomeController@welcome');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('update.role', 'HomeController@edit')->name('update.role');
Route::post('update.role.post/{id}', 'HomeController@update');
Route::get('book/{id}', 'HomeController@show')->name('book')->middleware('signed');
Route::post('appointment/{id}', 'BookingController@create');
Route::get('approve/{id}', 'BookingController@accept');
Route::get('doctor/{id}', 'DoctorController@create');
Route::post('doctor/pres/{id}', 'DoctorController@store');
Route::get('view/{id}', 'HomeController@view');
Route::get('profile', 'HomeController@profile')->name('profile');
Route::get('appointments','HomeController@appointments');
Route::get('appointments-update/{q}', 'BookingController@edit');
Route::post('appointment-update', 'BookingController@update');
Route::get('appointments-cancel/{q}', 'BookingController@destroy');
Route::get('patient-profile', 'HomeController@patientProfile')->name('patient-profile');
Route::get('doctor-profile/{q}', 'HomeController@doc');
Route::post('comment/{id}', 'HomeController@comment');
Route::get('doctor-index', 'DoctorController@index')->name('doctor.index');
Route::post('appointment/reschedule', "BookingController@reschedule");
Route::post('appointment-cancel','BookingController@cancelAppointment');
Route::get('history','BookingCOntroller@history')->name('history');
Route::post("search", "DoctorController@search")->name("search");