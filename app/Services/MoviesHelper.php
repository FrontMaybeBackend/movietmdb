<?php

namespace App\Services;

use App\Models\Movie;
use Illuminate\Support\Str;

class MoviesHelper
{

    public function fetchMovies()
    {
        $totalMovies = 51;
        $moviesPerPage = 20;
        $moviesFetched = 0;
        $pagesToFetch = ceil($totalMovies / $moviesPerPage);

        for ($page = 1; $page <= $pagesToFetch; $page++) {
            //Pobieram filmy z API
            $response = TMDBService::getPopularMovies($page);

            if ($response->successful()) {
                $movies = $response->json()['results'];

                foreach ($movies as $movie) {
                    if ($moviesFetched >= $totalMovies) {
                        break;
                    }

                    $result = [
                        'title' => $movie['title'],
                        'overview' => $movie['overview'],
                        'tmdb_id' => $movie['id'],
                        'language' => $movie['original_language'],
                        'slug' => Str::slug($movie['title'])
                    ];

                    Movie::query()->updateOrCreate(
                        ['tmdb_id' => $movie['id']],
                        $result
                    );

                    $moviesFetched++;
                }
            } else {
                throw new \Exception('Error fetching movies: ' . $response->body());
            }
        }
    }

}
