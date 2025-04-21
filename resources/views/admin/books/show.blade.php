@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2>Detail Buku</h2>
    <div class="card">
        <div class="card-body">
            <h4>{{ $book->title }}</h4>
            <p><strong>Penulis:</strong> {{ $book->author }}</p>
            <p><strong>Kategori:</strong> {{ $book->category }}</p>
            <p><strong>Stok:</strong> {{ $book->stock }}</p>
            <a href="{{ route('admin.books.index') }}" class="btn btn-secondary">Kembali</a>
        </div>
    </div>
</div>
@endsection
