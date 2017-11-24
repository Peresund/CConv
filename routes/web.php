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

//Route::get('/updateCurrencies', 'Home\HomeController@updateCurrencies');

Route::get('/updateCurrencies', 'Home\HomeController@updateCurrencies');
Route::post('/updateCurrencies', 'Home\HomeController@updateCurrencies');

Route::get('/getCurrencies', 'Home\HomeController@getCurrencies');
Route::post('/getCurrencies', 'Home\HomeController@getCurrencies');

Route::get('/clearCurrencies', 'Home\HomeController@clearCurrencies');
Route::post('/clearCurrencies', 'Home\HomeController@clearCurrencies');