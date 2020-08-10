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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/categories', 'Api\CategoryApiController@getAll');
Route::post('/hobbies/add', 'Api\HobbiesApiController@add');
Route::get('/users/{id}/hobbies', 'Api\UsersApiController@getHobbiesById');
Route::post('/users/{id}/follow', 'Api\UsersApiController@follow');
Route::delete('/users/{id}/unfollow', 'Api\UsersApiController@unfollow');
Route::get('/users/{id}/followers', 'Api\UsersApiController@getFollowers');
Route::get('/users/{id}/following', 'Api\UsersApiController@getFollowing');
Route::get('/hobbies/latest', 'Api\HobbiesApiController@showHobbies');
