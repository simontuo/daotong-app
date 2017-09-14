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
Route::get('/', 'HomeController@test')->name('index');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/email/verify/{token}', ['as' => 'email.verify', 'uses' => 'EmailController@verify']);

Route::get('/users/{id}/edit', 'UsersController@edit')->name('users.edit');
Route::patch('/users/{id}', 'UsersController@update')->name('users.update');
