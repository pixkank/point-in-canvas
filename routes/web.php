<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/point-to-canvas', function () {
    return view('point-to-canvas');
});