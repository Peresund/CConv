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

Route::get('/', "Home\HomeController@index");
Route::get('/test', "Home\HomeController@test");

//Route::get('/test', 'Home\HomeController@get_message');
//Route::post('/test', 'Home\HomeController@get_message');