<?php

namespace App\Http\Controllers;

use App\Models\Serie;
use Illuminate\Support\Facades\DB;

class SerieController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('serie.index',[
            'series' => DB::table('series')->get()
        ]);
    }

    public function show(Serie $serie) {
        return view('serie.show',[
            'serie' => $serie
        ]);
    }


}
