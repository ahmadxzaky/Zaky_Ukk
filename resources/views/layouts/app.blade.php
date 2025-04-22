<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perpustakaan Digital</title>
    <link href="{{ asset('bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light shadow-lg">
        <div class="container">
            <a class="navbar-brand" href="{{ url('/admin/dashboard') }}">Perpustakaan Digital</a>
            <div class="collapse navbar-collapse">
                <ul class="navbar-nav ms-auto">
                    @auth
                        @if (auth()->user()->role === 'admin')
                            <a href="{{ route('admin.dashboard') }}" class="btn btn-success mb-3">Dashboard</a>
                        @endif
                        @if (auth()->user()->role === 'officer')
                            <a href="{{ route('officers.dashboard') }}" class="btn btn-success mb-3">Dashboard</a>
                        @endif
                        @if (auth()->user()->role === 'visitor')
                            <a href="{{ route('visitor.index') }}" class="btn btn-success mb-3">Dashboard</a>
                        @endif
                        <li class="nav-item">
                            <form action="{{ route('logout') }}" method="POST"
                                onsubmit="return confirm('Apakah anda yakin ingin keluar?');">
                                @csrf
                                <button type="submit" class="btn btn-danger">Logout</button>
                            </form>
                        </li>
                    @else
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">Login</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">Register</a>
                        </li>
                    @endauth
                </ul>
             </div>
        </div>
    </nav>

    <div class="container mt-4">
        @yield('content')
    </div>
</body>

</html>
