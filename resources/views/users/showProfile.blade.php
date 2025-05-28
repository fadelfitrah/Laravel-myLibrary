@extends('layouts.user')
@section('title', 'Profile')
@section('content')
<div class="max-w-5xl h-[70vh] mx-auto mt-10">
    <h1 class="text-2xl font-bold mb-6">User Profile</h1>
    <div class="bg-white rounded shadow p-6">
        <div class="flex items-center mb-4">
            @if($user->profile_image)
                <img src="{{ $user->profile_image }}" alt="{{ $user->name }}" class="w-24 h-24 rounded-full mr-4">
            @else
                <div class="w-24 h-24 bg-gray-200 rounded-full mr-4 flex items-center justify-center text-gray-500">No Image</div>
            @endif
            <div>
                <h2 class="text-xl font-semibold">{{ $user->name }}</h2>
                <p class="text-sm text-gray-600">{{ $user->email }}</p>
            </div>
        </div>
        @if($user->books_borrowed_count > 0)
            <a href="{{ route('users.loans', $user->id) }}"><span class="bg-yellow-100 text-yellow-800 px-2 py-1 rounded-full text-xs">Borrowed Books: {{ $user->books_borrowed_count }}</span></a>
        @else
            <a href="{{ route('users.loans', $user->id) }}"><span class="bg-green-100 text-green-800 px-2 py-1 rounded-full text-xs">No Borrowed Books</span></a>
        @endif
        <p class="text-sm text-gray-500 my-2">Joined: {{ $user->created_at->format('d M Y') }}</p>
        <p class="text-sm text-gray-500 mb-4">Role: {{ $user->role }}</p>
        <a href="{{ route('users.edit', $user->id) }}" class="inline-block bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Edit Profile</a>
    </div>
</div>
@endsection