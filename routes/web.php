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

//test git orther user
Route::get('/', 'HomeController@test');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
