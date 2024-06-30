<?php

use App\Http\Controllers\GenreController;
use App\Http\Controllers\MovieController;
use App\Http\Controllers\SerieController;
use App\Http\Controllers\TranslationMovieController;
use App\Http\Controllers\TranslationSerieController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/movie/{movie}',[MovieController::class,'show'])->name('movie.show');
Route::get('/movie', [MovieController::class,'index'])->name('movie');

//Translations movies
Route::get('/movie/show/pl', [TranslationMovieController::class, 'showTranslateMovieInPL'])->name('movie.show-pl');
Route::get('/movie/show/de', [TranslationMovieController::class, 'showTranslateMovieInDE'])->name('movie.show-de');

//Translations series
Route::get('/series/show/pl', [TranslationSerieController::class, 'showTranslateSerieInPL'])->name('serie.show-pl');
Route::get('/series/show/de', [TranslationSerieController::class, 'showTranslateSerieInDE'])->name('serie.show-de');



Route::get('/serie/{serie}', [SerieController::class,'show'])->name('serie.show');
Route::get('/serie', [SerieController::class,'index'])->name('serie');



Route::get('/genre/{genre}',[GenreController::class,'show'])->name('genre.show');
Route::get('/genre', [GenreController::class,'index'])->name('genre');
