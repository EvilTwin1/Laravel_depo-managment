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


Route::post('/store', 'MainController@store')->name('store');
Route::post('/update/{id}', 'MainController@update')->name('update');
Route::delete('/destroy/{id}', 'MainController@destroy')->name('destroy');


Route::get('/', 'MainController@home')->name('home');
Route::get('/create', 'MainController@create')->name('create');
Route::get('/edit/{id}', 'MainController@edit')->name('edit');

Route::get('/autoparks', 'AutoparkController@index')->name('autoparks');
Route::get('/autoparks/{id}/show', 'AutoparkController@show')->name('autoparks.show');

Route::get('/cars', 'CarController@index')->name('cars');
Route::get('/cars/{id}/show', 'CarController@show')->name('cars.show');
