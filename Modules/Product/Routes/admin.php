<?php

use Illuminate\Support\Facades\Route;

Route::get('products', [
    'as' => 'admin.products.index',
    'uses' => 'ProductController@index',
    'middleware' => 'can:admin.products.index',
]);

Route::get('styling', [
    'as' => 'admin.products.styling.index',
    'uses' => 'ProductController@stylingIndex',
]);

Route::get('styling/create', [
    'as' => 'admin.products.styling.create',
    'uses' => 'ProductController@stylingCreate',
]);

Route::post('styling', [
    'as' => 'admin.products.styling.store',
    'uses' => 'ProductController@stylingSave',
]);

Route::get('styling/edit/{id}', [
    'as' => 'admin.styling.edit',
    'uses' => 'ProductController@stylingEdit',
]);

Route::post('styling/update/{id}', [
    'as' => 'admin.styling.update',
    'uses' => 'ProductController@stylingUpdate',
]);


Route::delete('styling/{ids}', [
    'as' => 'admin.styling.destroy',
    'uses' => 'ProductController@stylingDestroy',
]);

Route::get('products/create', [
    'as' => 'admin.products.create',
    'uses' => 'ProductController@create',
    'middleware' => 'can:admin.products.create',
]);

Route::post('products', [
    'as' => 'admin.products.store',
    'uses' => 'ProductController@store',
    'middleware' => 'can:admin.products.create',
]);

Route::get('products/{id}/edit', [
    'as' => 'admin.products.edit',
    'uses' => 'ProductController@edit',
    'middleware' => 'can:admin.products.edit',
]);

Route::put('products/{id}', [
    'as' => 'admin.products.update',
    'uses' => 'ProductController@update',
    'middleware' => 'can:admin.products.edit',
]);

Route::delete('products/{ids}', [
    'as' => 'admin.products.destroy',
    'uses' => 'ProductController@destroy',
    'middleware' => 'can:admin.products.destroy',
]);
