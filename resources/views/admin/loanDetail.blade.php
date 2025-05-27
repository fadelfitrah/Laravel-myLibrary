@extends('layouts.admin')
@section('ttl', 'Loans Details')
@section('content')
<div class="max-w-4xl mx-auto mt-10">
    <h1 class="text-2xl font-bold mb-6">Loan Detail</h1>
    @if(session('success'))
        <div class="mb-4 p-3 text-green-600">
            {{ session('success') }}
        </div>
    @endif
    <div class="bg-white flex rounded shadow p-6">
        <div class="flex flex-col w-full">
            <div class="flex flex-col w-full">
                <h1 class="my-4 font-bold">Borrowed By:</h1>       
                <div class="flex space-x-4 mb-4 bg-gray-100 p-4 rounded w-auto">
                    <img src="{{ $loan->user->profile_image }}" alt="User Image" class="w-[20rem] h-40 object-cover rounded-md mb-4">
                    <strong class="text-2xl"> {{ $loan->user->name }} <br> <span class="text-lg font-normal">({{ $loan->user->email }})</span>
                    <br> <span class="text-lg font-normal">({{ $loan->user->phone }})</span>
                    </strong>
                </div>
                <h1 class="my-4 font-bold">Book Details</h1>
                <div class="flex space-x-4 mb-4 bg-gray-100 p-4 rounded">
                    <img src="{{ $loan->book->image_url }}" alt="Book Image" class="w-[20rem] h-40 object-cover mb-4 rounded">
                    <strong class="text-2xl"> {{ $loan->book->title }} 
                        <br> <span class="text-lg font-normal">by {{ $loan->book->author }}</span>
                    </strong>
                </div>
            </div>
            <div class="mb-4">
                <strong>Borrowed At:</strong> {{ $loan->borrowed_at }}
            </div>
            <div class="mb-4">
                <strong>Due Date:</strong> {{ $loan->due_date }}
            </div>
            <div class="mb-4">
                <strong>Returned At:</strong> 
                @if($loan->returned_at)
                {{ $loan->returned_at }}
                @else
                <span class="text-gray-500">Not Returned</span>
                @endif
            </div>
            <div class="mb-4">
                <strong>Status:</strong>
                <span class="px-2 py-1 rounded
                @if($loan->status == 'borrowed') bg-yellow-200 text-yellow-800
                @elseif($loan->status == 'late') bg-red-200 text-red-800
                @else bg-green-200 text-green-800
                @endif">
                {{ ucfirst($loan->status) }}
            </span>
        </div>
        <div class="mb-4">
            <a href="{{ route('admin.loans.edit', $loan->id) }}" class="inline-block bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Edit Loan</a>
        </div>
    </div>
    </div> 
</div>
@endsection