<?php

use App\Http\Controllers\GenreController;
use App\Http\Controllers\MovieController;
use App\Http\Controllers\SerieController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/movie/{movie}',[MovieController::class,'show'])->name('movie.show');
Route::get('/movie', [MovieController::class,'index'])->name('movie');

//Translations
Route::get('/movie/show/pl', [MovieController::class, 'showTranslateInPL'])->name('movie.show-pl');




Route::get('/serie/{serie}', [SerieController::class,'show'])->name('serie.show');
Route::get('/serie', [SerieController::class,'index'])->name('serie');



Route::get('/genre/{genre}',[GenreController::class,'show'])->name('genre.show');
Route::get('/genre', [GenreController::class,'index'])->name('genre');
