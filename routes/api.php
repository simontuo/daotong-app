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

Route::namespace('Api')->group(function () {

    Route::middleware('auth:api')->post('/upload/cover', 'UploadsController@cover');
    Route::middleware('auth:api')->post('/upload/markdownImage', 'UploadsController@markdownImage');
    Route::middleware('auth:api')->post('/upload/listImage', 'UploadsController@listImage');

    Route::middleware('auth:api')->get('/user/followers/{id}', 'FollowersController@index');
    Route::middleware('auth:api')->post('/user/follow', 'FollowersController@follow');

    Route::get('/articles/rankingList', 'ArticleController@rankingList');
    Route::get('/articles/search', 'ArticlesController@search');
    Route::get('/articles/index', 'ArticlesController@index');

    Route::get('/calligraphys/index', 'CalligraphysController@index');
    Route::get('/calligraphys/search', 'CalligraphysController@search');
    Route::get('/calligraphys/rankingList', 'CalligraphysController@rankingList');

    Route::get('/likes/{type}/{id}', 'LikesController@index');
    Route::middleware('auth:api')->post('/likes/store', 'LikesController@store');

    Route::get('/comments/index', 'CommentsController@index');
    Route::get('/comments/{type}/{id}', 'CommentsController@getCommentsByIdAndType');
    Route::get('/comments/{id}', 'CommentsController@getUserComments');
    Route::middleware('auth:api')->post('/comments/store', 'CommentsController@store');

    Route::middleware('auth:api')->post('/messages/store', 'MessagesController@store');
    Route::middleware('auth:api')->post('/messages/reply', 'MessagesController@reply');
    Route::get('/messages/index', 'MessagesController@index');
    Route::get('/messages/{id}', 'MessagesController@getUserMessages');
    Route::get('/messages/{id}/{dialog}', 'MessagesController@userMessageDialog');

    Route::middleware('auth:api')->get('/notifications/{id}', 'NotificationsController@index');
    Route::middleware('auth:api')->get('/notifications/noRead', 'NotificationsController@noRead');

    Route::get('/topics', 'TopicsController@index');

    Route::middleware('auth:api')->get('/users/index', 'UsersController@index');
});


Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
