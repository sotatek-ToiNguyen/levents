<?php

use Illuminate\Support\Facades\Route;

Route::prefix('collection')->group(function() {
    Route::get('/', [
        'as' => 'collection.list',
        'uses' => 'PostController@list',
    ]);
    Route::get('/{slug}', [
        'as' => 'collection.show',
        'uses' => 'PostController@show',
    ]);
});
