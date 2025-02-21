<?php

namespace App\Services;

use App\Models\Season;

class SeasonsHelper
{
    protected EpisodesHelper $episodesHelper;
    public function __construct(EpisodesHelper $episodesHelper) {
        $this->episodesHelper = $episodesHelper;
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
                $this->episodesHelper->fetchEpisodes($tmdbId,$season,$seasonModel->id);
            }
        } catch (\Exception $e) {
            \Log::error("Error with fetchSeasons for serie ID: {$tmdbId} - " . $e->getMessage());
            throw $e;
        }
        }

}
