<?php

namespace App\Http\Controllers;

use App\Http\Requests\PrefixRequest;
use App\Models\Prefix;
use Illuminate\Http\Request;

class PrefixController extends Controller
{


    public function edit($type)
    {
        $prefix = Prefix::where('type', $type)->firstOrFail();
        return view('prefix.edit', compact('prefix'));
    }

    public function update(PrefixRequest $request, $type)
    {
        $prefix = Prefix::where('type', $type)->firstOrFail();
        $prefix->update(['value' => $request->value]);
        return redirect()->route('prefix.edit', $type)->with('success', 'Prefix updated successfully');
    }

    public function create()
    {
        return view('prefix.create');
    }

    public function store(PrefixRequest $request)
    {
        Prefix::create($request->validated());
        return redirect()->route('prefix.create')->with('success', 'Prefix added successfully');
    }

}
