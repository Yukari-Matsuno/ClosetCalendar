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

Route::get('/', 'TopController@show');
Route::get('how-to', 'HelpController@show');
Route::get('/home', 'CalenderController@index');
Route::get('calender', 'CalenderController@index');
Auth::routes();
Route::get('/logout', 'Auth\LoginController@logout');
// Route::get('create/sample', 'Admin\CoordinateController@add');

Route::group(['prefix' => 'admin'], function(){
    Route::get('calender', 'CalenderController@index')->middleware('auth');
    Route::get('coordinate/create', 'Admin\CoordinateController@add')->middleware('auth');
    Route::post('coordinate/create', 'Admin\CoordinateController@create')->middleware('auth');
    Route ::get('coordinate/detail', 'CalenderController@show')->middleware('auth');
    Route::get('coordinate/edit', 'Admin\CoordinateController@edit')->middleware('auth');
    Route::post('coordinate/edit', 'Admin\CoordinateController@update')->middleware('auth');
    Route::get('coordinate/delete', 'Admin\CoordinateController@destroy')->middleware('auth');
    Route::get('happybirthday', 'Admin\BirthdayController@show')->middleware('auth');
    Route::get('Coordinate/list','Admin\CoordinateListController@index')->middleware('auth');
 });
