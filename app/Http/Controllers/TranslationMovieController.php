<?php

namespace App\Http\Controllers;

use App\Models\Translations;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TranslationMovieController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function showTranslateMovieInPL()
    {
        $translationsPL = DB::table('translations')->whereNotNull('trans_pl_title')->paginate(20);
        return view('translation-movie.show-pl', [
            'translationsPL' => $translationsPL
        ]);
    }

    public function showTranslateMovieInDE()
    {
        $translationsDE = DB::table('translations')->whereNotNull('trans_de_title')->paginate(20);
        return view('translation-movie.show-de', [
            'translationsDE' => $translationsDE
        ]);
    }
}
