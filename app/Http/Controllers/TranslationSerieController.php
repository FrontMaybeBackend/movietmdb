<?php

namespace App\Http\Controllers;
use App\Models\TranslationSerie;
use Illuminate\View\View;

class TranslationSerieController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function showTranslate(string $language): View
    {
        $translations = TranslationSerie::whereNotNull("trans_{$language}_title")->paginate(10);
        return view("translation-serie.show-{$language}", [
            'translations' => $translations
        ]);
    }


}
