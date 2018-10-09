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
use Illuminate\Support\Facades\Auth;

Route::get('/', 'IndexController@index');

// 詳細ページ
Route::get('/items/{id}', 'ItemController@show');

// キーワード・タグ・製作者検索
Route::get('/search', 'SearchController@search');
Route::get('/tags/{tag_id}', 'TagController@show'); // sho
Route::get('/users/{user_name}', 'UserController@show'); // ryu

// 投稿フォーム
Route::get('/new', 'NewController@form');
Route::post('/new/add', 'NewController@add');


// Github認証
Route::get('/auth/github', 'Auth\SocialController@redirectToProvider');
Route::get('/auth/github/callback', 'Auth\SocialController@handleProviderCallback');
Route::get('/logout', 'Auth\SocialController@logout');


/*
/search?q=
/tags/xx
/users/xx
/items/xx
/new
*/

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
