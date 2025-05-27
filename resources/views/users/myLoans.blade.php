@extends('layouts.user')
@section('title', 'My Loans')

@section('content')
<div class="max-w-5xl mx-auto mt-10">
    <h1 class="text-2xl font-bold mb-6">My Loans</h1>
    @if(session('success'))
        <div class="mb-4 p-3 bg-green-100 text-green-700 rounded">
            {{ session('success') }}
        </div>
    @endif

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        @forelse($loans as $loan)
            <div class="bg-white rounded shadow p-5 flex flex-col">
                <div class="flex items-center mb-4">
                    @if($loan->book && $loan->book->image_url)
                        <img src="{{ asset($loan->book->image_url) }}" alt="{{ $loan->book->title }}" class="w-24 h-32 object-cover rounded mr-4">
                    @else
                        <div class="w-24 h-32 bg-gray-200 flex items-center justify-center rounded mr-4 text-gray-500">No Image</div>
                    @endif
                    <div>
                        <h2 class="text-lg font-semibold">{{ $loan->book->title ?? '-' }}</h2>
                        <p class="text-sm text-gray-600">Author: {{ $loan->book->author ?? '-' }}</p>
                        <p class="text-sm my-2 text-gray-600">Status: 
                            <span class="px-2 py-1 rounded
                                @if($loan->status == 'borrowed') bg-yellow-200 text-yellow-800
                                @elseif($loan->status == 'late') bg-red-200 text-red-800
                                @else bg-green-200 text-green-800
                                @endif">
                                {{ ucfirst($loan->status) }}
                            </span>
                        </p>
                    </div>
                </div>
                <div class="mb-2">
                    <span class="font-semibold">Borrowed At:</span>
                    {{ $loan->borrowed_at ? \Carbon\Carbon::parse($loan->borrowed_at)->format('Y-m-d') : '-' }}
                </div>
                <div class="mb-2">
                    <span class="font-semibold">Due Date:</span>
                    {{ $loan->due_date ? \Carbon\Carbon::parse($loan->due_date)->format('Y-m-d') : '-' }}
                </div>
                <div class="mb-2">
                    <span class="font-semibold">Returned At:</span>
                    {{ $loan->returned_at ? \Carbon\Carbon::parse($loan->returned_at)->format('Y-m-d') : '-' }}
                </div>
                <div class="mt-3">
                    @if($loan->status == 'borrowed')
                        <form action="{{ route('loans.return', $loan->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to return this book?');">
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="returned_at" id="" value="{{ \Carbon\Carbon::now()->format('Y-m-d') }}" class="border rounded px-2 py-1 mb-2" required>

                            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Return Book</button>
                        </form>
                    @else
                        <span class="text-gray-400">Book Returned</span>
                    @endif
                </div>
            </div>
        @empty
            <div class="col-span-2 text-center text-gray-500 py-10">No loan data found.</div>
        @endforelse
    </div>
</div>
@endsection