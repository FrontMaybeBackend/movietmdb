<?php

namespace App\Services;

use App\Models\Genre;

class GenresHelper
{

    public function fetchGenres()
    {
        try {
            $genres = TMDBService::getGenres();
            if ($genres) {
                foreach ($genres as $genre) {
                    $result = [
                        'title' => $genre['name'],
                        'tmdb_id' => $genre['id'],
                    ];

                    Genre::query()->updateOrCreate(
                        ['tmdb_id' => $genre['id']],
                        $result
                    );
                }
            } else {
                throw new \Exception('Error fetching genres: Empty response received');
            }
        } catch (\Exception $e) {
            throw new \Exception('Error fetching genres: ' . $e->getMessage());
        }
    }

}
