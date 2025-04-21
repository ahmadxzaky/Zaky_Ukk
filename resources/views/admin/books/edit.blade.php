@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2>Edit Buku</h2>
    <form action="{{ route('admin.books.update', $book) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="title" class="form-label">Judul</label>
            <input type="text" class="form-control" name="title" value="{{ $book->title }}" required>
        </div>
        <div class="mb-3">
            <label for="author" class="form-label">Penulis</label>
            <input type="text" class="form-control" name="author" value="{{ $book->author }}" required>
        </div>
        <div class="mb-3">
            <label for="category" class="form-label">Kategori</label>
            <input type="text" class="form-control" name="category" value="{{ $book->category }}" required>
        </div>
        <div class="mb-3">
            <label for="stock" class="form-label">Stok</label>
            <input type="number" class="form-control" name="stock" value="{{ $book->stock }}" required>
        </div>
        <button type="submit" class="btn btn-success">Update Buku</button>
        <a href="{{ route('admin.books.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection
