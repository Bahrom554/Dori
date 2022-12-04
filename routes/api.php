<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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


Route::post('message', 'Admin\MessageController@store');
Route::get('message', 'Admin\MessageController@findex');
Route::group(['namespace' => 'User'], function () {
    Route::get('posts','PostController@index');
    Route::get('posts/{slug}', 'PostController@slug')->where('slug', '[A-aZ-z0-9-]+');
    Route::get('settings','SettingController@index');

});
