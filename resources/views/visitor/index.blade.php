@extends('layouts.app')

@section('content')
    <div class="container py-y">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h2 class="text-primary">Dashboard Visitor</h2>
            <div>
                <a href="{{ route('loans.index') }}" class="btn btn-success me-2">Riwayat Peminjaman</a>
                <a href="{{ route('loans.create') }}" class="btn btn-primary">Pinjam Buku</a>
            </div>
        </div>

        <div class="card shadow-lg">
            <div class="card-body">
                <h5 class="card-title">Daftar Buku Tersedia</h5>
                <table class="table table-striped table-bordered mt-3">
                    <thead class="table-light">
                        <tr>
                            <th>Judul</th>
                            <th>Penulis</th>
                            <th>Kategori</th>
                            <th>Stok</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($books as $book)
                            <tr>
                                <td>{{ $book->title }}</td>
                                <td>{{ $book->author }}</td>
                                <td>{{ $book->category }}</td>
                                <td>{{ $book->stock }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center text-muted">Tidak ada buku yang tersedia.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection



