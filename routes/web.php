<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', 'IndexController@index');

Auth::routes();

//user routes
Route::get('/home', 'HomeController@index')->name('home');
Route::get('datatables/assignments', 'HomeController@getAssignments');
Route::get('/profile', 'HomeController@profile');
Route::post('/profile/change', 'HomeController@changeProfile');

//admin routes
Route::get('/admin/home', 'AdminController@index');
Route::get('/admin/datatables/packages', 'AdminController@getPackages');
Route::get('/admin/batteries', 'AdminController@batteries');
Route::get('/admin/datatables/batteries', 'AdminController@getBatteries');
Route::post('/admin/batteries/add', 'AdminController@addBattery');
Route::get('/admin/batteries/remove/{id}', 'AdminController@removeBattery');
Route::get('/admin/stations', 'AdminController@stations');
Route::get('/admin/datatables/stations', 'AdminController@getStations');
Route::post('admin/station/add', 'AdminController@addStation');
Route::get('admin/stations/remove/{id}', 'AdminController@removeStation');
Route::get('admin/users/search', 'AdminController@searchUsers');
Route::get('admin/model/search', 'AdminController@searchModel');
Route::get('admin/stations/search', 'AdminController@searchStations');
Route::get('admin/users', 'AdminController@users');
Route::get('/admin/datatables/users', 'AdminController@getUsers');
Route::post('admin/vehicle/assign', 'AdminController@assignVehicle');
Route::get('/admin/assignments', 'AdminController@assignments');
Route::get('/admin/datatables/assignments', 'AdminController@getAssignments');
Route::post('/admin/assignments/add', 'AdminController@addAssignment');
Route::get('/admin/pricing', 'AdminController@pricing');
Route::get('/admin/profile', 'AdminController@profile');
