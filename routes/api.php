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

Route::prefix('api')->group(function () {
    //Assignments
    Route::post('/locks', 'LocksController@create');

    Route::get('/locks/{lock_id?}', 'LocksController@get');

    Route::put('/locks/{lock_id}', 'LocksController@update');

    Route::delete('/locks/{lock_id}', 'LocksController@delete');

    //Users
    Route::post('/users', 'UsersController@create');

    Route::get('/users/{user_id?}', 'UsersController@get');

    Route::put('/users/{user_id}', 'UsersController@update');

    Route::delete('/users/{user_id}', 'UsersController@delete');

});