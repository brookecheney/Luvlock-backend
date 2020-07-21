<?php


/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$router->get('/', function () use ($router) {
    return $router->app->version();
});


$router->group(['prefix' => 'api'], function () use ($router) {
    //Assignments


    $router->get('locks/{lock_id}', 'LocksController@get');

    $router->get('locks', 'LocksController@get');
    $router->get('locks/', 'LocksController@get');

    $router->post('locks', 'LocksController@create');
    $router->post('locks/', 'LocksController@create');

    $router->put('locks/{lock_id}', 'LocksController@update');

    $router->delete('locks/{lock_id}', 'LocksController@delete');

    //Users
    $router->post('users', 'UsersController@create');

    $router->get('users/{user_id?}', 'UsersController@get');
    $router->get('users', 'UsersController@get');

    $router->put('users/{user_id}', 'UsersController@update');

    $router->delete('users/{user_id}', 'UsersController@delete');
});


