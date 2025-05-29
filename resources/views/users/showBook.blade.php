@extends('layouts.user')
@section('title', 'Book Details')
@section('content')
@if(session('success'))
    <div class="max-w-5xl mx-auto mt-4">
        <div class="bg-green-100 text-green-800 p-4 rounded">
            {{ session('success') }}
        </div>
    </div>
@endif
@if($errors->any())
    <div class="max-w-5xl mx-auto mt-4">
        <div class="bg-red-100 text-red-800 p-4 rounded">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    </div>
@endif
<div class="max-w-5xl mx-auto mt-10">
    <h1 class="text-2xl font-bold mb-6">{{ $book->title }}</h1>
    <div class="bg-white rounded shadow p-6">
        <div class="flex flex-col md:flex-row">
            @if($book->image_url)
                <img src="{{ asset($book->image_url) }}" alt="{{ $book->title }}" class="w-full md:w-1/3 h-full object-cover mb-4 md:mb-0 md:mr-6 rounded">
            @else
                <div class="w-full md:w-1/3 h-64 bg-gray-200 flex items-center justify-center mb-4 md:mb-0 md:mr-6 rounded text-gray-500">No Image</div>
            @endif
            <div class="flex-1">
                <p class="text-sm text-gray-600 mb-2">Author: {{ $book->author }}</p>
                <p class="text-sm text-gray-600 mb-2">Genre: {{ $book->genre->name ?? '-' }}</p>
                <p class="text-sm text-gray-600 mb-2">Published: {{ $book->published_date ? \Carbon\Carbon::parse($book->published_date)->format('d M Y') : '-' }}</p>
                <p class="text-sm text-gray-600 mb-4">Status: 
                @if($book->borrowed_status)
                    <span class="text-red-600 font-semibold">Borrowed</span>
                @else
                    <span class="text-green-600 font-semibold">Available</span>
                @endif
                </p>
                <p class="text-sm text-justify w-[25rem]">{{ $book->description }}</p>
            </div>
            @if(auth()->check())
                <form action="{{ route('loans.store') }}" method="POST" class="mt-4">
                    @csrf
                    <input type="hidden" name="book_id" value="{{ $book->id }}">
                    <input type="hidden" name="user_id" value="{{ auth()->id() }}">
                    <div>
                        <label for="borrowed_at" class="block mb-1">Borrow Date</label>
                        <input type="date" name="borrowed_at" class="border rounded px-2 py-1" required>
                    </div>
                    <div class="mt-2">
                        <label for="due_date" class="block mb-1">Due Date</label>
                        <input type="date" name="due_date" class="border rounded px-2 py-1" required>
                    </div>
                    <button type="submit" class="mt-3 bg-blue-600 text-white px-4 py-2 rounded">Borrow</button>
                </form>
            @endif
        </div>
    </div>
@endsection