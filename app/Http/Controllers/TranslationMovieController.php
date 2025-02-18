<?php

namespace App\Http\Controllers;

use App\Models\Translations;
use Illuminate\View\View;

class TranslationMovieController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function showTranslate(string $language): View
    {
        $translations = Translations::whereNotNull("trans_{$language}_title")->paginate(20);
        return view("translation-movie.show-{$language}", [
            'translations' => $translations
        ]);
    }
}
