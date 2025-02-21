<?php

namespace App\Services;

use App\Models\Episode;

class EpisodesHelper
{


    public function fetchEpisodes($tmdbId, $season, $seasonId)
    {
        $episodeDetails = TMDBService::getEpisodes($tmdbId, $season['season_number']);

        if (!$episodeDetails->successful()) {
            \Log::warning("Error fetching details for serie ID: {$tmdbId} " . $episodeDetails->body());
        }

        $episodeData = $episodeDetails->json();

        foreach ($episodeData['episodes'] as $episode) {
            if (!$episode) {
                continue;
            }

            Episode::updateOrCreate(
                [
                    'season_id' => $seasonId,
                    'episode_id' => $episode['id'],
                ],
                [
                    'episode_number' => $episode['episode_number'],
                    'name' => $episode['name'],
                    'overview' => $episode['overview'] ?? '',
                ]
            );
        }
    }

}
