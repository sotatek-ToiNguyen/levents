<?php

use Illuminate\Support\Facades\Route;

Route::get('product/{id}', 'ProductController@showApi')->name('productsApi.show');
