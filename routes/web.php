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

Route::get('/genre/{genre}',[GenreController::class,'show'])->name('genre.show');
Route::get('/genre', [GenreController::class,'index'])->name('genre');

Route::get('/serie/{serie}', [SerieController::class,'show'])->name('serie.show');
Route::get('/serie', [SerieController::class,'index'])->name('serie');


Route::prefix('/genre')->group(function () {
    Route::get('/show/{language}', [GenreController::class, 'showTranslate'])
        ->name('genre.translate')
        ->where(['language' => 'pl|de']);
});

Route::prefix('/movie')->group(function () {
    Route::get('/show/{language}', [TranslationMovieController::class, 'showTranslate'])
        ->name('movie.translate')
        ->where(['language' => 'pl|de']);
});

Route::prefix('/serie')->group(function () {
    Route::get('/show/{language}', [TranslationSerieController::class, 'showTranslate'])
        ->name('serie.translate')
        ->where(['language' => 'pl|de']);
});
