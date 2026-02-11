<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Movie;

class CatalogController extends Controller
{
    public function getIndex()
    {
        $peliculas = Movie::all();
        return view('catalog.index', ['arrayPeliculas' => $peliculas]);
    }

    public function getShow($id)
    {
        $pelicula = Movie::findOrFail($id);
        return view('catalog.show', ['pelicula' => $pelicula]);
    }

    public function getCreate()
    {
        return view('catalog.create');
    }

    public function getEdit($id)
    {
        $pelicula = Movie::findOrFail($id);
        return view('catalog.edit', ['pelicula' => $pelicula]);
    }

    public function postCreate(Request $request)
    {
        $p = new Movie();
        $p->title = $request->input('title');
        $p->year = $request->input('year');
        $p->director = $request->input('director');
        $p->poster = $request->input('poster');
        $p->synopsis = $request->input('synopsis');
        $p->rented = false; // Default value
        $p->save();

        return redirect('/catalog');
    }

    public function putEdit(Request $request, $id)
    {
        $p = Movie::findOrFail($id);
        $p->title = $request->input('title');
        $p->year = $request->input('year');
        $p->director = $request->input('director');
        $p->poster = $request->input('poster');
        $p->synopsis = $request->input('synopsis');
        $p->save();

        return redirect('/catalog/show/' . $id);
    }
}
