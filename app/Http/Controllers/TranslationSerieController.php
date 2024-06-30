<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;

class TranslationSerieController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function showTranslateSerieInDE()
    {
        $translationsDE = DB::table('translation_series')->whereNotNull('trans_de_title')->paginate(10);
        return view('translation-serie.show-de', [
            'translationsDE' => $translationsDE
        ]);
    }

    public function showTranslateSerieInPL()
    {
        $translationsPL = DB::table('translation_series')->whereNotNull('trans_pl_title')->paginate(10);
        return view('translation-serie.show-pl', [
            'translationsPL' => $translationsPL
        ]);
    }


}
