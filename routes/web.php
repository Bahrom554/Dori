<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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

Route::get('/',function (){
    return redirect(route('login'));
});

Route::get('/storage-link',function (){
 $targetFolder=storage_path('app/public');
 $linkfolder=$_SERVER['DOCUMENT_ROOT'].'images';
 symlink($targetFolder,$linkfolder);
});
Route::group(['middleware' => 'auth'], function () {
    Route::group(['namespace' => 'Filemanager', 'prefix' => 'admin/filemanager'], function () {
        Route::get('/', 'FilemanagerController@index');
        Route::delete('/{id}', 'FilemanagerController@delete');
        Route::post('/uploads', 'FilemanagerController@uploads')->name('image.upload');
    });
    Route::group(['namespace' => 'Admin', 'prefix' => 'admin'], function () {
        Route::get('/home', 'HomeController@index')->name('home');
        Route::resource('/post', 'PostController');
        Route::resource('/setting', 'SettingController');
        Route::get('header','PostController@header')->name('post.header');
        Route::get('message', 'MessageController@index')->name('message.index');
        Route::get('message/{message}', 'MessageController@show')->name('message.show');
        Route::delete('message/{message}', 'MessageController@destroy')->name('message.destroy');

    });
});
Auth::routes();
