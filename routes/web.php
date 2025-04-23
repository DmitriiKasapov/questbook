<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('pages.home');
});


/**
 * 404
 */
Route::fallback(function() {
    abort(404);
});
