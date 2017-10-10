<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware('auth:api')->post('/upload/cover', 'UploadController@cover');
Route::middleware('auth:api')->post('/upload/markdownImage', 'UploadController@markdownImage');

Route::middleware('auth:api')->get('/user/followers/{id}', 'FollowerController@index');
Route::middleware('auth:api')->post('/user/follow', 'FollowerController@follow');

Route::get('/articles/rankingList', 'ArticleController@rankingList');

Route::get('/likes/{type}/{id}', 'LikeController@index');
Route::middleware('auth:api')->post('/likes/store', 'LikeController@store');

Route::get('/comments/{type}/{id}', 'CommentsController@index');
Route::middleware('auth:api')->post('/comments/store', 'CommentsController@store');

Route::get('/notifications/{id}', 'NotificationsController@index');
