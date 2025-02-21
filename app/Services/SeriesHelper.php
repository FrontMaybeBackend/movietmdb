<?php

namespace App\Services;

use App\Models\Episode;
use App\Models\Season;
use App\Models\Serie;
use Illuminate\Support\Str;

class SeriesHelper
{
    public SeasonsHelper $seasonsHelper;
    public function __construct(SeasonsHelper $seasonsHelper)
    {
        $this->seasonsHelper = $seasonsHelper;
    }

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

                    $serieModel = Serie::query()->updateOrCreate(
                        ['tmdb_id' => $serie['id']],
                        $result
                    );
                    $this->seasonsHelper->fetchSeasons($serie['id'], $serieModel->id);
                    $seriesFetched++;
                }
            } else {
                throw new \Exception('Error fetching series: ' . $response->body());
            }
        }
    }



}
