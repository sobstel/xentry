<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::auth();

Route::get(
    '/',
    [
        'middleware' => 'auth',
        'uses' => 'UsersController@index'
    ]
);

Route::resource(
    'users',
    'UsersController',
    [
        'only' => ['index', 'show']
    ]
);

Route::put(
    'users/{user_id}/follow',
    [
        'middleware' => 'auth',
        'as' => 'user.follow',
        'uses' => 'UsersController@follow'
    ]
);

Route::delete(
    'user/{user_id}/unfollow',
    [
        'middleware' => 'auth',
        'as' => 'user.unfollow',
        'uses' => 'UsersController@unfollow'
    ]
);
