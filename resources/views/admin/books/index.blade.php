@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2 class=" mb-4">Daftar Buku</h2>

    <div class="d-flex justify-content-between mb-3">
        @if (auth()->user()->role === 'admin')
            <a href="{{ route('admin.dashboard') }}" class="btn btn-success">Back</a>
        @endif
        <a href="{{ route('admin.books.create') }}" class="btn btn-success">Tambah Buku</a>
    </div>

    <div class="table-responsive">
        <table class="table table-bordered table-hover text-center">
            <thead class="table-light">
                <tr>
                    <th>Judul</th>
                    <th>Penulis</th>
                    <th>Kategori</th>
                    <th>Stok</th>
                    <th>foto</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($books as $book)
                <tr>
                    <td>{{ $book->title }}</td>
                    <td>{{ $book->author }}</td>
                    <td>{{ $book->category }}</td>
                    <td>{{ $book->stock }}</td>
                    <td>
                        <img src="{{ asset('storage/' . $book->foto) }}" alt="" style="width : 30px">
                      </td>
                    <td class="text-center">
                        <div class="d-flex justify-content-center gap-2">
                            <a href="{{ route('admin.books.show', $book) }}" class="btn btn-info btn-sm">Detail</a>
                            <a href="{{ route('admin.books.edit', $book) }}" class="btn btn-warning btn-sm">Edit</a>
                            <form action="{{ route('admin.books.destroy', $book->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus buku ini?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                            </form>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
