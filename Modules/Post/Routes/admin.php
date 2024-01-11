<?php

use Illuminate\Support\Facades\Route;


Route::get('post', [
    'as' => 'admin.post.index',
    'uses' => 'PostController@index',
]);

Route::get('/post/create', [
    'as' => 'admin.post.create',
    'uses' => 'PostController@create',
]);
Route::post('/post', [
    'as' => 'admin.post.store',
    'uses' => 'PostController@store',
]);

Route::get('post/edit/{id}', [
    'as' => 'admin.post.edit',
    'uses' => 'PostController@edit',
]);

Route::post('post/update/{id}', [
    'as' => 'admin.post.update',
    'uses' => 'PostController@update',
]);


Route::delete('post/{ids}', [
    'as' => 'admin.post.destroy',
    'uses' => 'PostController@destroy',
]);
