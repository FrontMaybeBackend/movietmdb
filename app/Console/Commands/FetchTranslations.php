<?php

namespace App\Console\Commands;

use App\Models\Movie;
use App\Models\Serie;
use App\Models\Translations;
use App\Models\TranslationSerie;
use App\Services\TMDBService;
use Illuminate\Console\Command;

class FetchTranslations extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'fetch-translations';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->fetchTranslations();
    }

    public function fetchTranslations()
    {
        $movies = Movie::all();

        foreach ($movies as $movie) {
            $this->MakeTranslations($movie->tmdb_id, 'movie', $movie->id, true);
        }

        $series = Serie::all();

        foreach ($series as $serie) {
            $this->MakeTranslations($serie->tmdb_id, 'tv', $serie->id, false);
        }
    }
    private function MakeTranslations($tmdbID, $type, $id, bool $isMovie)
    {
        $languages = [
            'pl' => 'Polski',
            'de' => 'Deutsch'
        ];


        //Pobieram tłumaczenia z API
        $response = TMDBService::getTranslations($type,$tmdbID);

        if ($response->successful()) {
            $data = $response->json();

            foreach ($languages as $langCode => $langName) {
                //Pobieram tlumaczenia dla Polski i Niemiec
                $translation = collect($data['translations'])->firstWhere('name', $langName);

                //Jeśli są to ustawiam w tablicy, jesli nie to jest null
                if ($translation) {
                    $translationData = $translation['data'] ?? [];

                    $updateData = [
                        'movie_id' => $id,
                    ];

                    if ($isMovie) {
                        if ($langCode === 'pl') {
                            $updateData['trans_pl_title'] = $translationData['title'];
                            $updateData['trans_pl_overview'] = $translationData['overview'];
                        } elseif ($langCode === 'de') {
                            $updateData['trans_de_title'] = $translationData['title'];
                            $updateData['trans_de_overview'] = $translationData['overview'];
                        }
                        Translations::query()->updateOrCreate(
                            [
                                'movie_id' => $id,
                            ],
                            $updateData
                        );
                    } else {
                        if ($langCode === 'pl') {
                            $updateData['trans_pl_title'] = $translationData['name'];
                            $updateData['trans_pl_overview'] = $translationData['overview'];
                        } elseif ($langCode === 'de') {
                            $updateData['trans_de_title'] = $translationData['name'];
                            $updateData['trans_de_overview'] = $translationData['overview'];
                        }
                        TranslationSerie::query()->updateOrCreate(
                            [
                                'serie_id' => $id,
                            ],
                            $updateData
                        );
                    }
                    $this->info("Successfully added {$type} with TMDB ID {$tmdbID} in {$langName} to the database");
                } else {
                    $this->error("Failed, {$type} with TMDB ID {$tmdbID} doesn't have a translation in {$langName}");
                }
            }
        } else {
            $this->error('Failed, can\'t get translations');
        }
    }

}
