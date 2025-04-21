@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Daftar Peminjaman</h2>

    <a href="{{ route('loans.index') }}" class="btn btn-primary mt-2">Kelola Peminjaman</a>
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif


    <table class="table table-bordered mt-3">
        <thead>
            <tr>
                <th>Nama Peminjam</th>
                <th>Judul Buku</th>
                <th>Tanggal Pinjam</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($loans as $loan)
                <tr>
                    <td>{{ $loan->user->name ?? '-' }}</td>
                    <td>{{ $loan->book->title }}</td>
                    <td>{{ \Carbon\Carbon::parse($loan->borrow_date)->format('d-m-Y') }}</td>
                    <td>{{ ucfirst($loan->status) }}</td>
                    <td>
                        @if(auth()->user()->role === 'officer' && $loan->status === 'borrowed')
                            <form action="{{ route('loans.return.shared', $loan->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <button type="submit" class="btn btn-sm btn-success">Kembalikan Buku</button>
                            </form>
                        @else
                            <span class="text-muted">-</span>
                        @endif
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5">Tidak ada data peminjaman.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
