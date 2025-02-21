<?php

namespace App\Http\Controllers;

use App\Models\Season;
use App\Models\Serie;
use Illuminate\View\View;

class SerieController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        return view('serie.index', [
            'series' => Serie::paginate(10)
        ]);
    }


    public function show(Serie $slug): View
    {
        $seasons = $slug->seasons;
        return view('serie.show', [
            'serie' => $slug,
            'seasons' => $seasons
        ]);
    }

    public function showSeason(Season $season): View
    {
        $episodes = $season->episodes()->paginate(50);
        return view('season.episodes', compact('season', 'episodes'));
    }

}
