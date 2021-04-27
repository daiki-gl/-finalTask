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

// Route::get('/', function () {
//     return view('welcome');
// });
// Route::get('/home', 'HomeController@index')->name('home');

//Auth::routes();

//--------------------------
//ログアウト中のページ
//--------------------------
Route::get('/login', 'Auth\LoginController@login');
Route::post('/login', 'Auth\LoginController@login');
// Route::post('/login', 'Auth\LoginController@authenticate');

Route::get('/register', 'Auth\RegisterController@registerForm');
Route::post('/register', 'Auth\RegisterController@store');

//--------------------------
//ログイン中のページ
//--------------------------
Route::group(['middleware' => ['web']], function () {
    //トップ
    Route::get('/top','PostsController@index');
    Route::get('/top','Controller@getFollowCount');

    // 投稿関係
    Route::post('/create', 'PostsController@create');
    Route::get('/top', 'PostsController@read');
    Route::get('{id}/delete', 'PostsController@delete');
    Route::post('{id}/update', 'PostsController@update');
    
    // プロフィール
    Route::get('/profile','UsersController@profile');
    
    Route::post('/profile/{id}/update','UsersController@profUpdate');
    // パスワード取得確認
    Route::get('/profile','UsersController@loginUser');
    
    // フォローリスト
    Route::get('/follow-list','FollowsController@followList');
    Route::get('/follow-list', 'PostsController@readFollow');
    
    // フォロワーリスト
    Route::get('follower-list','FollowsController@followerList');
    Route::get('/follower-list', 'PostsController@readFollower');
    
    // ログアウト
    Route::get('/logout','Auth\LoginController@loggedOut');
    
    // 検索ページ
    Route::get('/search','UsersController@allUser');
    Route::post('/search','UsersController@searchKeyword');
    
    //   フォロー・フォロー解除
    Route::post('/search/{id}/follow', 'FollowsController@follow');
    Route::post('/search/{id}/unfollow', 'FollowsController@unfollow');
    

    Route::get('/follow_profile','PostsController@followProf')->name('follow_profile');

});
