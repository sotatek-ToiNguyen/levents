<?php

use Illuminate\Support\Facades\Route;

Route::prefix('post')->group(function() {
    Route::get('/', function(){
        echo 222;
        die();
    });
});
