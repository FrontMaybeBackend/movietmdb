<?php

namespace App\Console\Commands;

use App\Models\Translations;
use Illuminate\Console\Command;
use App\Models\Movie;
use App\Models\Serie;
use App\Models\Genre;
use Illuminate\Support\Facades\Http;

class GetDataTMBD extends Command
{

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:get-data-t-m-b-d';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Get data from api TMBD';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->getMovies();
        $this->getSeries();
        $this->getGenres();
        $this->fetchTranslations();

    }


    public function getMovies()
    {
        $totalMovies = 50;
        $moviesPerPage = 20;
        $moviesFetched = 0;
        $pagesToFetch = ceil($totalMovies / $moviesPerPage);
        for ($page = 1; $page <= $pagesToFetch; $page++) {

            $response = Http::get('https://api.themoviedb.org/3/movie/popular', [
                'api_key' => env('API_APP_KEY'),
                'language' => 'en-Us',
                'page' => $page,
            ]);

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
                    ];

                    Movie::query()->updateOrCreate(
                        ['tmdb_id' => $movie['id']],
                        $result
                    );

                    $moviesFetched++;
                }

                $this->info('Pomyślnie dodano filmy do bazy.');
            } else {
                $this->error('Error fetching movie: ' . $response->body());
                return;
            }
        }
    }


    public function getSeries()
    {
        $totalSeries = 10;
        $seriesPerPage = 20;
        $seriesFetched = 0;
        $pagesToFetch = ceil($totalSeries / $seriesPerPage);
        for ($page = 1; $page <= $pagesToFetch; $page++) {

            $response = Http::get('https://api.themoviedb.org/3/tv/popular', [
                'api_key' => env('API_APP_KEY'),
                'language' => 'en-Us',
                'page' => $page,
            ]);

            $series = $response->json();
            if (isset($series['results'])) {
                foreach ($series['results'] as $serie) {
                    if ($seriesFetched >= $totalSeries) {
                        break;
                    }
                    $result = [
                        'title' => $serie['name'],
                        'overview' => $serie['overview'],
                        'tmdb_id' => $serie['id'],
                    ];
                    Serie::query()->updateOrCreate(['tmdb_id' => $serie['id']], $result);
                    $seriesFetched++;
                }
                $this->info('Pomyślnie dodano series do bazy');
            } else {
                $this->error('No movie found in the response.');
            }
        }
    }

    public function getGenres()
    {
        $response = Http::get('https://api.themoviedb.org/3/genre/movie/list', [
            'api_key' => env('API_APP_KEY'),
            'language' => 'en',
        ]);

        $genres = $response->json();

        if (isset($genres['genres'])) {
            foreach ($genres['genres'] as $genre) {
                $result = [
                    'title' => $genre['name'],
                    'tmdb_id' => $genre['id'],
                ];
                Genre::query()->updateOrCreate($result);
            }
            $this->info('Pomyślnie dodano genres do bazy');
        } else {
            $this->error('No genres found in the response.');
        }
    }

    public function fetchTranslations()
    {
        $movie = Movie::all();
        foreach ($movie as $movies) {
            if ($movies) {
                $this->getTranslations($movies->tmdb_id, 'movie',$movies->id);
            }
        }


    }



    private function getTranslations($tmdbID, $type,$id)
    {
        $languages = [
            'pl' => 'Polski',
            'de' => 'Deutsch'
        ];

        $response = Http::get("https://api.themoviedb.org/3/{$type}/{$tmdbID}/translations", [
            'api_key' => env('API_APP_KEY')
        ]);

        if ($response->successful()) {
            $data = $response->json();

            foreach ($languages as $langCode => $langName) {
                $translation = collect($data['translations'])->firstWhere('name', $langName);

                if ($translation) {
                    $translationData = $translation['data'] ?? [];

                    $updateData = [
                        'movie_id' => $id,
                        'title' =>  null,
                        'overview' =>  null,
                    ];

                    if ($langCode === 'pl') {
                        $updateData['trans_pl_title'] = $translationData['title'] ;
                        $updateData['trans_pl_overview'] = $translationData['overview'] ;
                    } elseif ($langCode === 'de') {
                        $updateData['trans_de_title'] = $translationData['title'] ;
                        $updateData['trans_de_overview'] = $translationData['overview'] ;
                    }

                    Translations::query()->updateOrCreate(
                        [
                            'movie_id' => $id,
                        ],
                        $updateData
                    );

                    $this->info("Successfully added movie with TMDB ID {$tmdbID} in {$langName} to the database");
                } else {
                    $this->error("Failed, movie with TMDB ID {$tmdbID} doesn't have a translation in {$langName}");
                }
            }
        } else {
            $this->error('Failed, can\'t get translations');
        }
    }

}
