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

Route::middleware('auth:api')->post('/upload', function (Request $request) {
    dd(request()->all());
    return response()->json(['loadingStatus' => false,'name' => 'img', 'url' => 'http://photo.maguas.com//avatars/2512f102014dce572199eb5cc69456ae.png']);
    // abort(404);
});
