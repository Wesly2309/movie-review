<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CastController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MovieController;
use App\Http\Controllers\CommentController;



Route::get('/', function () {
    return redirect('/movies');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::resource('movies', MovieController::class);
Route::resource('casts', CastController::class);
Route::resource('movies.comments', CommentController::class)->shallow();


Route::post('/movies/{movies:id/{cast_store', [MovieController::class,'movie_cast_store'])->name('movie_cast_store');
Route::delete('/movies/{movies:id/casts/{cast:id', [MovieController::class, 'movie_cast_destroy'])->name('movie_cast_destroy');
