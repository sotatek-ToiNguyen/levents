<?php

use Illuminate\Support\Facades\Route;


Route::get('post', [
    'as' => 'admin.post.index',
    'uses' => 'PostController@index',
    'middleware' => 'can:admin.post.index',
]);
