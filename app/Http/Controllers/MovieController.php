<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use Illuminate\View\View;

class MovieController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        return view('movie.index', [
            'movies' => Movie::paginate(15)
        ]);
    }

    public function show(Movie $movie): View
    {
        return view('movie.show', [
            'movie' => $movie
        ]);
    }


}
