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


Route::get('/', 'HomeController@index')->name('index');

Route::resource('articles', 'ArticleController', ['names' => [
    '/'      => 'articles.index',
    'create' => 'articles.create',
    'store'  => 'articles.store',
    'show'   => 'articles.show',
]]);
Route::resource('calligraphys', 'CalligraphysController', ['names' => [
    'index'  => 'calligraphys.index',
    'create' => 'calligraphys.create',
    'store'  => 'calligraphys.store',
    'show'   => 'calligraphys.show',
]]);

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/email/verify/{token}', ['as' => 'email.verify', 'uses' => 'EmailController@verify']);

Route::get('/users/{id}/edit', 'UsersController@edit')->name('users.edit');
Route::patch('/users/{id}', 'UsersController@update')->name('users.update');
Route::get('/users/{id}/edit_password', 'UsersController@editPassword')->name('users.edit_password');
Route::post('/users/{id}/update_password', 'UsersController@updatePassword')->name('users.update_password');
Route::get('/users/{id}/center', 'UsersController@center')->name('users.center');

// Route::get('/users', 'UsersController@index')->name('admins.users.index');


// Route::get('logs', '\Rap2hpoutre\LaravelLogViewer\LogViewerController@index');


Route::get('/inboxs/{id}', 'InboxsController@index')->name('inboxs.index');
Route::get('/inboxs/{id}/{dialog}', 'InboxsController@show')->name('inboxs.show');


Route::namespace('Admin')->prefix('admin')->group(function () {
    Route::get('/', 'HomesController@index')->name('admin.home.index');
    Route::get('/users/index', 'HomesController@userIndex')->name('admin.users.index');
    Route::get('/articles/index', 'HomesController@articleIndex')->name('admin.articles.index');
    Route::get('/calligraphys/index', 'HomesController@calligraphyIndex')->name('admin.calligraphys.index');

    Route::get('/comments/index', 'HomesController@commentIndex')->name('admin.comments.index');
    Route::get('/messages/index', 'HomesController@messageIndex')->name('admin.messages.index');

    Route::get('/logs', 'HomesController@logIndex')->name('admin.logs.index');

});
