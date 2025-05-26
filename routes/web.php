<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\MovieController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [MovieController::class, 'homepage']);

Route::resource('/category', CategoryController::class);
// Route::resource('/movie', MovieController::class);

// Route::get('/movie/{slug}', [MovieController::class, 'show'])->name('movies.show');
// Route::get('/movie/{id}/{slug}', [MovieController::class, 'detail']);

Route::get('movie/{id}/{slug}', [MovieController::class, 'detail']);



