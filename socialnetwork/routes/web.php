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

Route::get('/', function () {
    return view('welcome');
})->middleware('web')->name("home");

Route::group(['middleware' => ['web']], function () {
    Route::post('/signup', 'UserController@postSignUp')->name('signup');
    Route::post('/signin', 'UserController@postSignIn')->name('signin');
    Route::get('/dashboard', 'UserController@getDashboard')->name('dashboard')->middleware("auth");
    Route::post('/createpost', 'PostController@postCreate')->name('post.create')->middleware("auth");
    Route::get('/deletepost/{post_id}', 'PostController@deletePost')->name('post.delete')->middleware("auth");
    Route::get('/logout/', 'UserController@getlogOut')->name('logout')->middleware("auth");
});


//Rename soon

Route::post('/edit/{post_id}', 'PostController@getDashboard')->name('post.edit')->middleware("auth");
