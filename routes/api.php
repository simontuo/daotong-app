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

Route::get('/index/search', 'HomeController@search');

Route::namespace('Api')->group(function () {

    Route::middleware('auth:api')->post('/upload/cover', 'UploadsController@cover');
    Route::middleware('auth:api')->post('/upload/markdownImage', 'UploadsController@markdownImage');
    Route::middleware('auth:api')->post('/upload/listImage', 'UploadsController@listImage');
    Route::middleware('auth:api')->post('/upload/users/{id}/avatar', 'UploadsController@avatar')->name('api.users.uploadAvatar');
    Route::middleware('auth:api')->post('/upload/users/{id}/wechatCode', 'UploadsController@wechatCode')->name('api.users.uploadWechatCode');
    Route::middleware('auth:api')->post('/upload/users/{id}/alipayCode', 'UploadsController@alipayCode')->name('api.users.uploadAlipayCode');

    Route::middleware('auth:api')->get('/user/followers/{id}', 'FollowersController@index');
    Route::middleware('auth:api')->post('/user/follow', 'FollowersController@follow');
    Route::middleware('auth:api')->get('/user/questions/followed/{id}', 'FollowersController@questionFollowed');


    Route::get('/articles/rankingList', 'ArticlesController@rankingList');
    Route::get('/articles/search', 'ArticlesController@search');
    Route::get('/articles/index', 'ArticlesController@index');
    Route::get('/articles/{id}', 'ArticlesController@getUserArticles');
    Route::middleware('auth:api')->post('/articles/{id}/closeComment', 'ArticlesController@closeComment');
    Route::middleware('auth:api')->post('/articles/{id}/isHidden', 'ArticlesController@isHidden');

    Route::get('/calligraphies/index', 'CalligraphiesController@index');
    Route::get('/calligraphies/search', 'CalligraphiesController@search');
    Route::get('/calligraphies/hot', 'CalligraphiesController@hot');
    Route::get('/calligraphies/{id}', 'CalligraphiesController@getUserCalligraphies');
    Route::middleware('auth:api')->post('/calligraphies/{id}/closeComment', 'CalligraphiesController@closeComment');
    Route::middleware('auth:api')->post('/calligraphies/{id}/isHidden', 'CalligraphiesController@isHidden');

    Route::get('/questions/index', 'QuestionsController@index')->name('api.questions.index');
    Route::get('/questions/search', 'QuestionsController@search')->name('api.questions.search');
    Route::get('/questions/{id}/answers', 'QuestionsController@answers')->name('api.questions.answers');
    Route::post('/questions/follow', 'QuestionsController@follow')->name('api.questions.follow');
    Route::middleware('auth:api')->post('/questions/{id}/closeComment', 'QuestionsController@closeComment');
    Route::middleware('auth:api')->post('/questions/{id}/isHidden', 'QuestionsController@isHidden');

    Route::get('/likes/{type}/{id}', 'LikesController@index');
    Route::middleware('auth:api')->post('/likes/store', 'LikesController@store');
    Route::middleware('auth:api')->post('/likes/dislikeStore', 'LikesController@dislikeStore');

    Route::get('/comments/index', 'CommentsController@index');
    Route::get('/comments/search', 'CommentsController@search');
    Route::get('/comments/{type}/{id}', 'CommentsController@getCommentsByIdAndType');
    Route::get('/comments/{id}', 'CommentsController@getUserComments');
    Route::middleware('auth:api')->post('/comments/store', 'CommentsController@store');
    Route::middleware('auth:api')->post('/comments/{id}/isHidden', 'CommentsController@isHidden');

    Route::middleware('auth:api')->post('/messages/store', 'MessagesController@store');
    Route::middleware('auth:api')->post('/messages/reply', 'MessagesController@reply');
    Route::get('/messages/index', 'MessagesController@index');
    Route::get('/messages/search', 'MessagesController@search');
    Route::get('/messages/{id}', 'MessagesController@getUserMessages');
    Route::get('/messages/{id}/{dialog}', 'MessagesController@userMessageDialog');
    Route::middleware('auth:api')->post('/messages/{id}/isHidden', 'MessagesController@isHidden');

    Route::middleware('auth:api')->get('/notifications/index', 'NotificationsController@index');
    Route::middleware('auth:api')->get('/notifications/noRead', 'NotificationsController@noRead');
    Route::middleware('auth:api')->get('/notifications/hasRead', 'NotificationsController@hasRead');
    Route::middleware('auth:api')->get('/notifications/{id}/read', 'NotificationsController@read');

    Route::get('/topics', 'TopicsController@index');
    Route::get('/topics/hot', 'TopicsController@hot');

    Route::middleware('auth:api')->get('/users/index', 'UsersController@index');
    Route::middleware('auth:api')->get('/users/search', 'UsersController@search');
    Route::middleware('auth:api')->post('/users/{id}/banComment', 'UsersController@banComment');
    Route::middleware('auth:api')->post('/users/{id}/banLogin', 'UsersController@banLogin');

    Route::middleware('auth:api')->get('/admin/articles/search', 'ArticlesController@adminSearch');
    Route::middleware('auth:api')->get('/admin/calligraphies/search', 'CalligraphiesController@adminSearch');
    Route::middleware('auth:api')->get('/admin/questions/search', 'QuestionsController@adminSearch');
    Route::middleware('auth:api')->get('/admin/answers/search', 'AnswersController@adminSearch');
    Route::middleware('auth:api')->get('/admin/mottoes/search', 'MottoesController@adminSearch');
    Route::middleware('auth:api')->get('/admin/suggestions/search', 'SuggestionsController@adminSearch');

    Route::middleware('auth:api')->get('/admin/logs/{file}/search', 'LogsController@search');
    Route::middleware('auth:api')->get('/admin/logs/getFiles', 'LogsController@getFiles');

    Route::get('/verifyCodes/registerCode', 'SmsController@registerCode');
    Route::get('/verifyCodes/verify/registerCode', 'SmsController@verifyRegisterCode');

    Route::get('/mottoes/index', 'MottoesController@index');
    Route::get('/mottoes/randomOne', 'MottoesController@randomOne');

});
