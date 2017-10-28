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
Route::middleware('auth:api')->post('/upload/listImage', 'UploadController@listImage');

Route::middleware('auth:api')->get('/user/followers/{id}', 'FollowerController@index');
Route::middleware('auth:api')->post('/user/follow', 'FollowerController@follow');

Route::get('/articles/rankingList', 'ArticleController@rankingList');
Route::get('/articles/articleList', 'ArticleController@articleList');

Route::get('/calligraphys/calligraphyList', 'CalligraphysController@calligraphyList');
Route::get('/calligraphys/rankingList', 'CalligraphysController@rankingList');

Route::get('/likes/{type}/{id}', 'LikeController@index');
Route::middleware('auth:api')->post('/likes/store', 'LikeController@store');

Route::get('/comments/{type}/{id}', 'CommentsController@index');
Route::get('/comments/{id}', 'CommentsController@getUserComments');
Route::middleware('auth:api')->post('/comments/store', 'CommentsController@store');

Route::middleware('auth:api')->get('/notifications/{id}', 'NotificationsController@index');
Route::middleware('auth:api')->get('/notifications/noRead', 'NotificationsController@noRead');

Route::middleware('auth:api')->post('/messages/store', 'MessagesController@store');
Route::middleware('auth:api')->post('/messages/reply', 'MessagesController@reply');
Route::get('/messages/{id}', 'MessagesController@index');
Route::get('/messages/{id}/{dialog}', 'MessagesController@userMessageDialog');

Route::get('/topics', 'TopicsController@index');
