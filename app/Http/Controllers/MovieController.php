<?php

namespace App\Http\Controllers;

use App\Http\Requests\PrefixRequest;
use App\Models\Movie;
use Illuminate\Support\Facades\Response;
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

    public function show(Movie $slug): View
    {
        return view('movie.show', [
            'movie' => $slug
        ]);
    }


}
