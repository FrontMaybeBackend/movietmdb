<?php

namespace App\Console\Commands;

use App\Services\SeriesHelper;
use Illuminate\Console\Command;

class FetchSeries extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'fetch-series';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Get series from TMDB';

    protected $getSeries;

    public function __construct(SeriesHelper $getSeries)
    {
        parent::__construct();
        $this->getSeries = $getSeries;
    }

    /**
     * Execute the console command.
     */
    public function handle()
    {
        try{
            $this->getSeries->fetchSeries();
            $this->info('Series successfully fetched from TMDB');
        }catch (\Exception $exception){
            $this->error($exception->getMessage());
        }
    }
}
