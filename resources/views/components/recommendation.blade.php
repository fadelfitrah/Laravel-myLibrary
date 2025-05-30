@if(isset($recommendedBooks) && $recommendedBooks->count())
<div class="container w-full mx-auto mt-4">
    <h2>Rekomendasi Buku Untuk Anda</h2>
        <div class="row">
            @foreach($recommendedBooks as $book)
                <div class="col-md-4 mb-3">
                    <div class="card h-100">
                        <div class="card-body">
                            <h5 class="card-title">{{ $book->title }}</h5>
                            <p class="card-text">{{ Str::limit($book->description, 100) }}</p>
                            <p class="card-text"><small class="text-muted">Genre: {{ $book->genre->name ?? '-' }}</small></p>
                            <a href="{{ route('books.show', $book->id) }}" class="btn btn-primary">Lihat Detail</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endif  