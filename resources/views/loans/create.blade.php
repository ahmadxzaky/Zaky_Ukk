@extends('layouts.app')

@section('content')
    <div class="container">
        <h2 class="mb-4">Pilih Buku yang Ingin Dipinjam</h2>

        @if(session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        <div class="row">
            @foreach($books as $book)
                <div class="col-12 col-sm-6 col-md-4 col-lg-3 d-flex">
                    <div class="card mb-4 flex-fill" style="font-size: 15px; box-shadow: 0 2px 6px rgba(0,0,0,0.1);">
                        {{-- Gambar buku --}}
                        <div style="background-color: #f8f9fa; padding: 12px; text-align: center;">
                            @if($book->foto)
                                <img src="{{ asset('storage/' . $book->foto) }}" alt="{{ $book->judul }}"
                                    style="height: 300px; width: auto; object-fit: contain;">
                            @else
                                <img src="https://via.placeholder.com/200x300?text=No+Image" alt="No image"
                                    style="height: 300px; width: auto; object-fit: contain;">
                            @endif
                        </div>

                        <div class="card-body d-flex flex-column p-3">
                            <h5 class="card-title" style="font-size: 16px;">{{ $book->title }}</h5>
                            <p class="card-text mb-1">Penulis: {{ $book->author }}</p>
                            <p class="card-text mb-2">Stok: {{ $book->stock }}</p>

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
