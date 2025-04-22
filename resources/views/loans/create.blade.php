@extends('layouts.app')

@section('content')
<div class="container py-4">
    <h2 class="mb-4 text-dark">Pilih Buku yang Ingin Dipinjam</h2>

    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <div class="row">
        @foreach($books as $book)
            <div class="col-12 col-sm-6 col-md-4 col-lg-3 d-flex">
                <div class="card mb-4 flex-fill shadow-sm" style="font-size: 15px;">
                    <div class="text-center p-3" style="background-color: white;">
                        @if($book->foto)
                            <img src="{{ asset('storage/' . $book->foto) }}"
                                 alt="{{ $book->title }}"
                                 style="height: 300px; object-fit: contain;">
                        @else
                            <img src="https://via.placeholder.com/200x300?text=No+Image"
                                 alt="No Image"
                                 style="height: 300px; object-fit: contain;">
                        @endif
                    </div>

                    <div class="card-body d-flex flex-column p-3">
                        <h5 class="card-title mb-2 text-truncate" style="font-size: 16px;">
                            {{ $book->title }}
                        </h5>
                        <p class="card-text mb-1">Penulis: <strong>{{ $book->author }}</strong></p>
                        <p class="card-text mb-3">Stok:
                            <span class="{{ $book->stock > 0 ? 'text-success' : 'text-danger' }}">
                                {{ $book->stock }}
                            </span>
                        </p>

                        <form action="{{ route('loans.store') }}" method="POST" class="mt-auto">
                            @csrf
                            <input type="hidden" name="book_id" value="{{ $book->id }}">
                            <button type="submit" class="btn btn-primary w-100" {{ $book->stock < 1 ? 'disabled' : '' }}>
                                {{ $book->stock < 1 ? 'Stok Habis' : 'Pinjam' }}
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
