<?php

namespace App\Http\Controllers;

use App\Models\Videojoc;
use Illuminate\Http\Request;

class VideojocController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $videojocs = Videojoc::orderBy('id')->paginate(10);
        $headers = ['ID', 'Nom', 'Plataforma', 'Any Estrena', 'Estat', 'Preu'];
        return view('videojocs/index', compact('headers', 'videojocs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('videojocs.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nom'           => 'required|string|max:150|unique:videojoc,nom',
            'plataforma'    => 'required|string|max:100',
            'any_estrena'   => 'required|integer|min:1500|max:' . date('Y'),
            'estat'         => 'required|in:disponible,prestat',
            'preu'          => 'required|numeric|min:0',
        ]);

        Videojoc::create($validated);

        return redirect()->route('videojocs.index')->with('status', 'Videojoc creat correctament');
    }

    /**
     * Display the specified resource.
     */
    public function show(Videojoc $videojoc)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Videojoc $videojoc)
    {
        return view('videojocs.edit', compact('videojoc'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Videojoc $videojoc)
    {
        $validated = $request->validate([
            'nom'           => 'required|string|max:150|unique:videojoc,nom,' . $videojoc->id,
            'plataforma'    => 'required|string|max:100',
            'any_estrena'   => 'required|integer|min:1500|max:' . date('Y'),
            'estat'         => 'required|in:disponible,prestat',
            'preu'          => 'required|numeric|min:0',
        ]);

        $videojoc->update($validated);

        return redirect()->route('videojocs.index')->with('status', 'Videojoc actualitzat correctament');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Videojoc $videojoc)
    {
        $videojoc->delete();
        return redirect()->route('videojocs.index')->with('status', 'Videojoc eliminat correctament');
    }
}
