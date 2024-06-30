<?php

namespace App\Console\Commands;

use App\Services\MoviesHelper;
use Illuminate\Console\Command;

class FetchMovies extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'fetch-movies';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Get Movies from TMDB';

    /**
     * Execute the console command.
     */

    protected $getMovies;
    public function __construct(MoviesHelper $getMovies)
    {
        parent::__construct();
        $this->getMovies = $getMovies;
    }

    public function handle()
    {
        try {
            $this->getMovies->fetchMovies();
            $this->info('Movies successfully fetched from TMDB.');
        } catch (\Exception $e) {
            $this->error($e->getMessage());
        }
    }
}
