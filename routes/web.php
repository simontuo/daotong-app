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

Route::get('/', 'ArticleController@index')->name('index');
Route::resource('articles', 'ArticleController', ['names' => [
    'create' => 'articles.create',
    'store'  => 'articles.store',
    'show'   => 'articles.show',
]]);

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/email/verify/{token}', ['as' => 'email.verify', 'uses' => 'EmailController@verify']);

Route::get('/users/{id}/edit', 'UsersController@edit')->name('users.edit');
Route::patch('/users/{id}', 'UsersController@update')->name('users.update');

Route::post('/users/{id}/update_avatar', 'UsersController@updateAvatar')->name('users.update_avatar');
Route::get('/users/{id}/edit_password', 'UsersController@editPassword')->name('users.edit_password');
Route::post('/users/{id}/update_password', 'UsersController@updatePassword')->name('users.update_password');
Route::get('/users/{id}/center', 'UsersController@center')->name('users.center');

// Route::get('/notifications', 'NotificationsController@index')->name('notifications.index');
