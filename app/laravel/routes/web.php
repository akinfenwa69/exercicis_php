<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\VideojocController;

// home (hello world)
Route::get('/', function () {
    return view('welcome');
});

// test
Route::get('/test', function () {
    return view('test');
});

// redirect to videojocs
Route::get('/', fn() => redirect()->route('videojocs.index'));
Route::resource('videojocs', VideojocController::class);
