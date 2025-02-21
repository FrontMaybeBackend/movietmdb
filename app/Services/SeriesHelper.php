<?php

namespace App\Services;

use App\Models\Episode;
use App\Models\Season;
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

                    $serieModel = Serie::query()->updateOrCreate(
                        ['tmdb_id' => $serie['id']],
                        $result
                    );

                    $this->fetchSeasons($serie['id'], $serieModel->id);

                    $seriesFetched++;
                }
            } else {
                throw new \Exception('Error fetching series: ' . $response->body());
            }
        }
    }

    public function fetchSeasons($tmdbId, $serieId)
    {
        try {
            $seasonDetails = TMDBService::getSeasons($tmdbId);

            if (!$seasonDetails->successful()) {
                throw new \Exception("Error fetching details for serie ID: {$tmdbId}");
            }

            $seasonData = $seasonDetails->json();

            foreach ($seasonData['seasons'] as $season) {
                if ($season['season_number'] == 0) {
                    continue;
                }

                $seasonModel = Season::updateOrCreate(
                    [
                        'serie_id' => $serieId,
                        'season_id' => $season['id'],
                    ],
                    [
                        'season_number' => $season['season_number'],
                        'name' => $season['name'],
                        'episode_number' => $season['episode_count'],
                        'overview' => $season['overview'] ?? '',
                    ]
                );


                try {
                    $episodeDetails = TMDBService::getEpisodes($tmdbId, $season['season_number']);

                    if (!$episodeDetails->successful()) {
                        \Log::warning(
                            "Could not fetch episodes for serie ID: {$tmdbId}, season: {$season['season_number']}"
                        );
                        continue;
                    }

                    $episodeData = $episodeDetails->json();


                    if (!isset($episodeData['episodes'])) {
                        \Log::warning(
                            "No episodes key in response for serie ID: {$tmdbId}, season: {$season['season_number']}"
                        );
                        continue;
                    }

                    foreach ($episodeData['episodes'] as $episode) {
                        if (!$episode) {
                            continue;
                        }

                        Episode::updateOrCreate(
                            [
                                'season_id' => $seasonModel->id,
                                'episode_id' => $episode['id'],
                            ],
                            [
                                'episode_number' => $episode['episode_number'],
                                'name' => $episode['name'],
                                'overview' => $episode['overview'] ?? '',
                            ]
                        );
                    }
                } catch (\Exception $e) {
                    \Log::error(
                        "Error processing episodes for serie ID: {$tmdbId}, season: {$season['season_number']} - " . $e->getMessage(
                        )
                    );
                    continue;
                }
            }
        } catch (\Exception $e) {
            \Log::error("Error in fetchSeasons for serie ID: {$tmdbId} - " . $e->getMessage());
            throw $e;
        }
    }


}
