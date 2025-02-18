<?php

namespace App\Http\Controllers;

use App\Models\Serie;
use Illuminate\View\View;

class SerieController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        return view('serie.index', [
            'series' => Serie::paginate(10)
        ]);
    }

    public function show(Serie $serie): View
    {
        return view('serie.show', [
            'serie' => $serie
        ]);
    }


}
