<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use App\Models\Translations;
use Illuminate\Support\Facades\DB;

class MovieController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('movie.index',[
            'movies' => DB::table('movies')->paginate(20)
        ]);
    }

    public function show(Movie $movie) {

        return view('movie.show',[
            'movie' => $movie
        ]);
    }

    public function showTranslateInPL()
    {
        $translationsPL = DB::table('translations')->whereNotNull('trans_pl_title')->get();
        return view('movie.show-pl', [
            'translationsPL' => $translationsPL
        ]);
    }


}
