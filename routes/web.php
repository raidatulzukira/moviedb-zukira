<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\MovieController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [MovieController::class, 'homepage']);

Route::resource('/category', CategoryController::class);

// Route::get('/movie/{slug}', [MovieController::class, 'show'])->name('movies.show');
// Route::get('/movie/{id}/{slug}', [MovieController::class, 'detail']);

Route::get('movie/{id}/{slug}', [MovieController::class, 'detail']);
// Route::get('create-movie', [MovieController::class, 'create'])->name('createMovie');
Route::get('create-movie', [MovieController::class, 'create'])->name('createMovie')->middleware('auth');
// Route::get('/create-movie', [MovieController::class, 'create'])->name('createMovie');
// Route::post('/movie', [MovieController::class, 'store'])->name('movie.store');
// Route::get('/create-movie', [MovieController::class, 'create'])->name('movies.create');
// Route::get('/create-movie', [MovieController::class, 'create'])->name('create_movie');
Route::post('/movies', [MovieController::class, 'store'])->name('movie.store')->middleware('auth');

// Route::post('/movie', [MovieController::class, 'store']);

Route::get('/login', [AuthController::class, 'loginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout']);
Route::get('/data-movie', [MovieController::class, 'dataMovie'])->middleware('auth');

