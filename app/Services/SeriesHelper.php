<?php

namespace App\Services;

use App\Models\Serie;

class SeriesHelper
{
    public function fetchSeries()
    {
        $totalSeries = 10;
        $seriesPerPage = 20;
        $seriesFetched = 0;
        $pagesToFetch = ceil($totalSeries / $seriesPerPage);

        for ($page = 1; $page <= $pagesToFetch; $page++) {
            //Pobieram seriale z API
            $response = TMDBService::getPopularSeries($page);

            if ($response->successful()) {
                $series = $response->json()['results'];

                foreach ($series as $serie) {
                    if ($seriesFetched >= $totalSeries) {
                        break;
                    }

                    $result = [
                        'title' => $serie['name'],
                        'overview' => $serie['overview'],
                        'tmdb_id' => $serie['id'],
                    ];

                    Serie::query()->updateOrCreate(
                        ['tmdb_id' => $serie['id']],
                        $result
                    );

                    $seriesFetched++;
                }
            } else {
                throw new \Exception('Error fetching series: ' . $response->body());
            }
        }
    }


}
