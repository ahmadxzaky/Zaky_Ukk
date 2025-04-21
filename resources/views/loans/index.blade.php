@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2 class="mb-4">Daftar Peminjaman Buku</h2>
    @if (auth()->user()->role === 'visitor')
    <a href="{{ route('loans.create') }}" class="btn btn-primary mb-3">Pinjam Buku</a>
    @endif

    @if (auth()->user()->role === 'admin')
    <a href="{{ route('admin.dashboard') }}" class="btn btn-success mb-3">back</a>
    <a href="{{ route('loans.export.pdf') }}" class="btn btn-danger mb-3">Download PDF</a>
    @endif
    @if (auth()->user()->role === 'officer')
    <a href="{{ route('officers.dashboard') }}" class="btn btn-success mb-3">back</a>
    <a href="{{ route('loans.export.pdf') }}" class="btn btn-danger mb-3">Download PDF</a>
    @endif
    @if (auth()->user()->role === 'visitor')
    <a href="{{ route('visitor.index') }}" class="btn btn-success mb-3">back</a>
    @endif
    <table class="table table-striped table-bordered">
        <thead class="">
            <tr>
                <th>ID</th>
                <th>Nama Visitor</th>
                <th>Buku</th>
                <th>Tanggal Pinjam</th>
                <th>Tanggal Kembali</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($loans as $loan)
            <tr>
                <td>{{ $loan->id }}</td>
                <td>{{ $loan->user->name }}</td>
                <td>{{ $loan->book->title }}</td>
                <td>{{ $loan->borrow_date }}</td>
                <td>{{ $loan->return_date ?? 'Belum dikembalikan' }}</td>
                <td>
                    <span class="badge bg-{{ $loan->status == 'borrowed' ? 'warning' : 'success' }}">
                        {{ ucfirst($loan->status) }}
                    </span>
                </td>

            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
