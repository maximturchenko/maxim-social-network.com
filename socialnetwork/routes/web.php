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

    Route::post('/dashboard', 'PostController@postCreate')->name('post.create')->middleware("auth");
});


//Rename soon

//Route::post('/dashboard545', 'PostController@getDashboard')->name('post.edit')->middleware("auth");
//Route::post('/dashboard535', 'PostController@getDashboard')->name('post.delete')->middleware("auth");
