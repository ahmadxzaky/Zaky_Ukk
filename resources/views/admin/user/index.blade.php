@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2 class="mb-4">Daftar Pengguna</h2>


    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if (auth()->user()->role === 'admin')
    <a href="{{ route('admin.dashboard') }}" class="btn btn-success mb-3">Back</a>
@endif

    <table class="table table-bordered table-striped">
        <thead class="table-Silver">
            <tr>
                <th>ID</th>
                <th>Nama</th>
                <th>Email</th>
                <th>Role</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
                <tr>
                    <td>{{ $user->id }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td><span class="badge bg-primary">{{ ucfirst($user->role) }}</span></td>
                    <td>
                        <a href="{{ route('admin.user.edit', $user->id) }}" class="btn btn-warning btn-sm">Edit Role</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
