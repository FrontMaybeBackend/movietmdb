<?php

namespace App\Console\Commands;

use App\Models\Translations;
use App\Models\TranslationSerie;
use App\Services\TMDBService;
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
        $this->call('fetch-movies');
        $this->call('fetch-series');
        $this->call('fetch-genres');
        $this->call('fetch-translations');
    }



}
