<?php

namespace App\Http\Controllers;

use App\Models\Genre;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;

class GenreController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('genre.index',[
            'genres'=> DB::table('genres')->paginate(10)
        ]);
    }

    public function show(Genre $genre) {
        return view('genre.show',[
            'genre' => $genre
        ]);
    }

    public function showTranslateGenreInPL()
    {
        App::setlocale('pl');
        $translationsPL = DB::table('genres')->paginate(10);
        return view('genre.show-pl', [
            'translationsPL' => $translationsPL
        ]);
    }

    public function showTranslateGenreInDE()
    {
        App::setlocale('de');
        $translationsDE = DB::table('genres')->paginate(10);
        return view('genre.show-pl', [
            'translationsPL' => $translationsDE
        ]);
    }

}
