@extends('layouts.app')

@section('content')
    <div class="container py-5">
        <div class="card shadow-lg">
            <div class="card-body">

                <div class="mb-4 text-center">
                    @if($book->foto)
                        <img src="{{ asset('storage/' . $book->foto) }}" alt="{{ $book->title }}"
                             class="img-fluid mx-auto d-block" style="max-width: 300px;">
                    @else
                        <img src="https://via.placeholder.com/300x450?text=No+Image" alt="No Image"
                             class="img-fluid mx-auto d-block" style="max-width: 300px;">
                    @endif
                </div>


                <div class="text-start mb-4">
                    <h5 class="card-title">{{ $book->title }}</h5>
                    <p class="card-text"><strong>Penulis:</strong> {{ $book->author }}</p>
                    <p class="card-text"><strong>Kategori:</strong> {{ $book->category }}</p>
                    <p class="card-text"><strong>Stok:</strong> {{ $book->stock }}</p>
                </div>

                @if(Auth::user()->role === 'visitor')
                    <div class="mb-4">
                        <p><strong>Sinopsis:</strong></p>
                        <p style="font-size: 14px; color: #555; text-align: justify;">{{ $book->sinopsis }}</p>
                    </div>
                @endif

                <div class="mt-4 text-center">
                    @if(Auth::user()->role === 'visitor')
                        <a href="{{ route('loans.create') }}" class="btn btn-primary">Pinjam Buku</a>
                    @endif
                    <a href="{{ route('visitor.index') }}" class="btn btn-secondary">Kembali ke Daftar Buku</a>
                </div>
            </div>
        </div>
    </div>
@endsection
