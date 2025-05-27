<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Book;
use App\Models\Genre;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        return view('admin.dashboard');
    }

    public function books()
    {
        $books = Book::with('genre')->get();
        $genres = Genre::all();

        return view('admin.books', compact('books', 'genres'));
    }

    public function genres()
    {
        $genres = Genre::all();
        return view('admin.genres', compact('genres'));
    }

    public function users()
    {
        $users = User::paginate(10);
        return view('admin.users', compact('users'));
    }

    public function userDestroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('admin.users')->with('success', 'User deleted successfully.');
    }

    public function bookStore(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'isbn' => 'nullable|string|max:20',
            'published_date' => 'nullable|date',
            'genre_id' => 'sometimes|required|exists:genres,id',
            'description' => 'nullable|string',
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('books', 'public');
            $validated['image_url'] = $imagePath;
        }
        else {
            $validated['image_url'] = null; 
        }

        Book::create($validated);

        return redirect()->route('admin.books')->with('success', 'Book created successfully.');
    }

    public function bookEdit($id)
    {
        $book = Book::findOrFail($id);
        $genres = Genre::all();

        return view('admin.editBook', compact('book', 'genres'));
    }

    public function bookUpdate(Request $request, $id)
    {
        $book = Book::findOrFail($id);

        $validated = $request->validate([
            'title' => 'sometimes|required|string|max:255',
            'author' => 'sometimes|required|string|max:255',
            'isbn' => 'nullable|string|max:20',
            'published_date' => 'nullable|date',
            'genre_id' => 'sometimes|required|exists:genres,id',
            'description' => 'nullable|string',
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'status' => 'sometimes|required|in:tersedia,dipinjam',
        ]);

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('books', 'public');
            $validated['image_url'] = $imagePath;
        }
        else {
            $validated['image_url'] = $book->image_url; 
        }

        $book->update($validated);

        return redirect()->route('admin.books')->with('success', 'Book updated successfully.');
    }

    public function bookDelete($id)
    {
        $book = Book::findOrFail($id);
        $book->delete();

        return redirect()->route('admin.books')->with('success', 'Book deleted successfully.');
    }


}
