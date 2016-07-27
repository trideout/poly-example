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

Route::get('/', [
    'as'   => 'posts.index',
    'uses' => 'PostsController@index'
]);

Route::post('/create', [
    'as'   => 'posts.create',
    'uses' => 'PostsController@post'
]);

Route::post('/like/{id?}', [
    'as'   => 'posts.like',
    'uses' => 'PostsController@likePost'
]);

Route::post('/like/comment/{id?}', [
    'as'   => 'posts.comment.like',
    'uses' => 'PostsController@likeComment'
]);

Route::post('/comment/{id}', [
    'as'   => 'posts.comment',
    'uses' => 'PostsController@comment'
]);