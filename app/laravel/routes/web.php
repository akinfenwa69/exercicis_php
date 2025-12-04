<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Videojocs
use App\Http\Controllers\VideojocController;

Route::resource('videojocs', VideojocController::class);
