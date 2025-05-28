<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Genre;
use App\Models\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function index()
    {
        $genres = Genre::all()->paginate(20);
        $books = Book::all();
        return view('users.dashboard', compact('books', 'genres'));
    }

    public function create()
    {
        $genres = Genre::all();
        return view('admin.createBook', compact('genres'));
    }

    public function show($id)
    {
        $book = Book::with('genre')->findOrFail($id);
        return view('users.showBook', compact('book'));
    }

    public function genreBook($genre_name)
    {
        $genres = Genre::all();
        $selectedGenre = Genre::where('name', $genre_name)->firstOrFail();
        $books = Book::with('genre')->whereHas('genre', function ($query) use ($selectedGenre) {
            $query->where('id', $selectedGenre->id);
        })->get();

        return view('users.dashboard', compact('books', 'genres', 'selectedGenre'));
    }

    public function getBookByName(Request $request)
    {
        $search = $request->input('search');
        $genres = Genre::all();
        $books = Book::where('title', 'like', '%' . $search . '%')
            ->orWhere('description', 'like', '%' . $search . '%')
            ->get();

        return view('users.dashboard', compact('books', 'genres'));
    }
}
