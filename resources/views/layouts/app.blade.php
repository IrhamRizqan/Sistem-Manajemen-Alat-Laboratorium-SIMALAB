<!doctype html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Beranda') | SIMALAB</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>

<body class="d-flex flex-column min-vh-100">
    <nav class="navbar navbar-expand-md navbar-dark bg-simalab-dark">
        <div class="container">
            <a class="navbar-brand fw-bold" href="{{ route('dashboard') }}">SIMALAB</a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navUtama"
                aria-controls="navUtama" aria-expanded="false" aria-label="Buka menu navigasi">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navUtama">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}"
                            href="{{ route('dashboard') }}">
                            Beranda
                        </a>
                    </li>
                </ul>

                <div class="d-flex align-items-center gap-3 mt-2 mt-md-0">
                    <span class="navbar-user">{{ auth()->user()->name }}</span>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="btn btn-outline-light btn-sm">Keluar</button>
                    </form>
                </div>
            </div>
        </div>
    </nav>

    <main class="container py-4 flex-grow-1">
        @if (session('status'))
            <div class="alert alert-success" role="status">{{ session('status') }}</div>
        @endif

        @yield('content')
    </main>

    <footer class="bg-white border-top py-3 mt-auto text-secondary small">
        <div class="container d-flex flex-column flex-sm-row justify-content-between gap-2">
            <span>SIMALAB | Sistem Manajemen Alat Laboratorium</span>
            <span>Kelompok IF-2: Irham Rizqan Zakiy dan Rashad Shaquille Taofik</span>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI"
        crossorigin="anonymous"></script>
</body>

</html>