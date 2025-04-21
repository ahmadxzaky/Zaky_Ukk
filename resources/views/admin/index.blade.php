@extends('layouts.app')

@section('content')
    <div class="container py-5">
        <div class="card shadow-lg p-4">
            <h1 class="text-center text-primary mb-4">Admin Dashboard</h1>
            <p class="text-center text-muted">
                Selamat datang, <strong>{{ Auth::user()->name }}</strong>!
            </p>

            <div class="row mt-4">


                <div class="col-md-4 mb-3">
                    <div class="card text-center border-0 shadow-lg h-100">
                        <div class="card-body d-flex flex-column justify-content-center">
                            <h2 class="h5">Manajemen Pengguna</h2>
                            <a href="{{ route('admin.user.index') }}" class="btn btn-primary mt-2">Kelola Pengguna</a>
                        </div>
                    </div>
                </div>


                @if (auth()->user()->role === 'admin' || auth()->user()->role === 'officer')
                    <div class="col-md-4 mb-3">
                        <div class="card text-center border-0 shadow-lg h-100">
                            <div class="card-body d-flex flex-column justify-content-center">
                                <h2 class="h5">Daftar Buku</h2>
                                <a href="{{ route('admin.books.index') }}" class="btn btn-primary mt-2">Daftar Buku</a>
                            </div>
                        </div>
                    </div>
                @endif

                <div class="col-md-4 mb-3">
                    <div class="card text-center border-0 shadow-lg h-100">
                        <div class="card-body d-flex flex-column justify-content-center">
                            <h2 class="h5">Manajemen Peminjaman</h2>
                            <a href="{{ route('loans.index') }}" class="btn btn-primary mt-2">Kelola Peminjaman</a>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
