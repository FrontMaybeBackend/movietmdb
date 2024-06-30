<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class TMDBService
{

    public static function getPopularMovies($page)
    {
        return Http::get('https://api.themoviedb.org/3/movie/popular', [
            'api_key' => env('API_APP_KEY'),
            'language' => 'en-Us',
            'page' => $page,
        ]);
    }

    public static function getPopularSeries($page)
    {
        return Http::get('https://api.themoviedb.org/3/tv/popular', [
            'api_key' => env('API_APP_KEY'),
            'language' => 'en-Us',
            'page' => $page,
        ]);
    }

    public static function getGenres()
    {
        $movieGenres = Http::get('https://api.themoviedb.org/3/genre/movie/list', [
            'api_key' => env('API_APP_KEY'),
            'language' => 'en-Us',
        ])->json()['genres'];

        $tvGenres = Http::get('https://api.themoviedb.org/3/genre/tv/list', [
            'api_key' => env('API_APP_KEY'),
            'language' => 'en-Us',
        ])->json()['genres'];

        return array_merge($movieGenres, $tvGenres);
    }

    public static function getTranslations($type, $tmdbID)
    {
        return Http::get("https://api.themoviedb.org/3/{$type}/{$tmdbID}/translations", [
            'api_key' => env('API_APP_KEY')
        ]);
    }

}
