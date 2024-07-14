<?php

use App\Http\Controllers\CastController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\MovieController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

// Redirect root to movies
Route::get('/', function () {
    return redirect('/movies');
});

// Authentication routes
Auth::routes();

// Home route
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Resource routes for movies, casts, and comments
Route::resource('movies', MovieController::class);
Route::resource('casts', CastController::class);

// Shallow nested routes for comments (related to movies)
Route::resource('movies.comments', CommentController::class)->shallow();

// Custom routes for handling movie-cast relationships
Route::post('/movies/{movie}/cast_store', [MovieController::class, 'movie_cast_store'])->name('movie_cast_store');
Route::get('/movies', [MovieController::class, 'index'])->name('movies.index');
Route::post('/movies', [MovieController::class, 'store'])->name('movies.store');
Route::post('/casts', [CastController::class, 'store'])->name('casts.store');
Route::get('/casts/{cast}', [CastController::class, 'show'])->name('casts.show'); // Ensure this route exists if needed
Route::get('/movies/create', [MovieController::class, 'create'])->name('movies.create');

// For Movies
Route::delete('/movies/{movie}', [MovieController::class, 'destroy'])->name('movies.destroy');
Route::delete('/movies/{movie}/casts/{cast}', [MovieController::class, 'movie_cast_destroy'])->name('movie_cast_destroy');

// For Casts
Route::delete('/casts/{cast}', [CastController::class, 'destroy'])->name('casts.destroy');

// For Adding Casts
Route::post('/casts', [CastController::class, 'store'])->name('casts.store');
