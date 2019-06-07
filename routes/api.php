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

// ログイン
Route::middleware('throttle')->post('/login', '\Laravel\Passport\Http\Controllers\AccessTokenController@issueToken')->name('login');

// ログアウト
Route::middleware('auth:api')->post('/logout', 'Auth\LogoutController@logout')->name('logout');
//Route::middleware('auth:api')->post('/logout', 'Auth\LoginController@logout')->name('logout');

// 会員登録
Route::post('/register', 'Auth\RegisterController@register')->name('register');

// 写真投稿
Route::middleware('auth:api')->post('/photos', 'PhotoController@create')->name('photo.create');

// 写真一覧
Route::get('/photos', 'PhotoController@index')->name('photo.index');

// 写真詳細
Route::get('/photos/{id}', 'PhotoController@show')->name('photo.show');

// コメント
Route::middleware('auth:api')->post('/photos/{photo}/comments', 'PhotoController@addComment')->name('photo.comment');

// いいね
Route::middleware('auth:api')->put('/photos/{id}/like', 'PhotoController@like')->name('photo.like');

// いいね解除
Route::middleware('auth:api')->delete('/photos/{id}/like', 'PhotoController@unlike');
