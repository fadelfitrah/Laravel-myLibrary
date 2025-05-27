@extends('layouts.user')
@section('content')
    <div class="container mx-auto px-4 py-8">
        <h1 class="text-2xl font-bold mb-6">Books in Genre: {{ $selectedGenre->name }}</h1>

        @if($books->isEmpty())
            <p class="text-gray-600">No books found in this category.</p>
        @else
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                @foreach($books as $book)
                    <div class="bg-white p-4 rounded shadow hover:shadow-lg transition duration-300 hover:scale-105 ease-in-out">
                        <img src="{{ $book->image_url }}" alt="Book Image" class="w-full h-40 object-cover mb-4 rounded">
                        <h2 class="text-lg font-semibold mb-2">{{ $book->title }}</h2>
                        <p class="text-gray-700 mb-4">{{ Str::limit($book->description, 100) }}</p>
                        <a href="{{ route('books.show', $book->id) }}" class="text-blue-500 hover:underline">View Details</a>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
    <div class="container mx-auto px-4 py-8">
        <h2 class="text-xl font-bold mb-4">Other Categories</h2>
        <ul class="list-disc pl-5">
            @foreach($genres as $otherGenre)
                <li>
                    <a href="{{ route('books.byGenre', $otherGenre->name) }}" class="text-blue-500 hover:underline">
                        {{ $otherGenre->name }}
                    </a>
                </li>
            @endforeach
        </ul>
    </div>
@endsection