<?php

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

// Web authenticated routes
Route::middleware('auth')->group(function() {
    Route::get('/users/{username}', function ($username) {
        return view('user_profile', ['username' => $username]);
    });

    Route::get('/categories/{id}', function ($id) {
        return view('category', ['id' => $id]);
    });
});

// API routes
Route::middleware('check.auth')->group(function() {
    Route::post('/api/users/{id}/follow', 'Api\UsersApiController@follow');
    Route::delete('/api/users/{id}/unfollow', 'Api\UsersApiController@unfollow');
    Route::get('/api/users/{id}/followers', 'Api\UsersApiController@getFollowers');
    Route::get('/api/users/{id}/following', 'Api\UsersApiController@getFollowing');
    Route::get('/api/users/{username}', 'Api\UsersApiController@getInfoByUsername');
    Route::post('/api/hobbies/add', 'Api\HobbiesApiController@add');
    Route::get('/api/hobbies/latest', 'Api\HobbiesApiController@showHobbies');
    Route::get('/api/hobbies/{id}/comments', 'Api\HobbiesApiController@getComments');
    Route::post('/api/hobbies/{id}/comment', 'Api\UsersApiController@addComment');
    Route::get('/api/categories', 'Api\CategoryApiController@getAll');
    Route::get('/api/categories/{id}/hobbies', 'Api\CategoryApiController@getHobbiesByCategory');
});
