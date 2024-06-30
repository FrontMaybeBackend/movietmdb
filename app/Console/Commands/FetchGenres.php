<?php

namespace App\Console\Commands;

use App\Services\GenresHelper;
use Illuminate\Console\Command;

class FetchGenres extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'fetch-genres';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Get genres from TMDB';

    protected  $getGenres;

    public function __construct(GenresHelper $getGenres)
    {
        parent::__construct();
        $this->getGenres = $getGenres;
    }

    /**
     * Execute the console command.
     */
    public function handle()
    {
        try {
            $this->getGenres->fetchGenres();
            $this->info('Genres successfully fetched from TMDB.');
        } catch (\Exception $e) {
            $this->error($e->getMessage());
        }
    }
}
