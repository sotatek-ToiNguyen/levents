<?php

use Illuminate\Support\Facades\Route;

Route::get('products', 'ProductController@index')->name('products.index');
Route::get('crew', 'ProductController@crew')->name('crew.index');
Route::get('products/{slug}', 'ProductController@show')->name('products.show');

Route::get('suggestions', 'SuggestionController@index')->name('suggestions.index');

Route::get('blogs/outfit/{slug}', 'ProductController@stylingIndex')->name('styling.index');
Route::get('blogs/outfit', 'ProductController@stylingList')->name('styling.list');

Route::post('products/{id}/price', 'ProductPriceController@show')->name('products.price.show');
