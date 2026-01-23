<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;

class CatalogController extends Controller
{
    public function getIndex()
    {
        $books = Book::all();
        return view('catalog.index', ['books' => $books]);
    }

    public function getShow($id)
    {
        $book = Book::findOrFail($id);
        return view('catalog.show', ['book' => $book]);
    }

    public function getCreate()
    {
        return view('catalog.create');
    }

    public function getEdit($id)
    {
        $book = Book::findOrFail($id);
        return view('catalog.edit', ['book' => $book]);
    }

    public function postCreate(Request $request)
    {
        $book = new Book();
        $book->title = $request->input('title');
        $book->year = $request->input('year');
        $book->author = $request->input('author');
        $book->cover = $request->input('cover');
        $book->synopsis = $request->input('synopsis');
        // available defaults to true
        $book->save();

        return redirect('/catalog');
    }

    public function putEdit(Request $request, $id)
    {
        $book = Book::findOrFail($id);
        $book->title = $request->input('title');
        $book->year = $request->input('year');
        $book->author = $request->input('author');
        $book->cover = $request->input('cover');
        $book->synopsis = $request->input('synopsis');
        $book->save();

        return redirect('/catalog/show/' . $id);
    }
}
