<?php

namespace App\Http\Controllers;

use App\Models\Genre;
use Illuminate\Support\Facades\App;
use Illuminate\View\View;

class GenreController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        return view('genre.index', [
            'genres' => Genre::paginate(15)
        ]);
    }


    public function show(Genre $genre): View
    {
        return view('genre.show', [
            'genre' => $genre
        ]);
    }

    public function showTranslate(string $language): View
    {
        App::setlocale($language);
        $translations = Genre::paginate(15);
        return view("genre.show-{$language}", [
            'translations' => $translations
        ]);
    }

}
