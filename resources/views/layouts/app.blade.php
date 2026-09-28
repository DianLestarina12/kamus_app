<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Kamus Anggah-Ungguh Kruna Basa Bali')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-user sticky-top">
        <div class="container">
            <a class="navbar-brand brand-kamus" href="{{ route('kamus.beranda') }}">
                <span>Kamus Anggah-Ungguh</span>
                <span>Kruna Basa Bali</span>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarUser">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarUser">
                <ul class="navbar-nav ms-lg-auto align-items-lg-center mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('kamus.*') ? 'active' : '' }}" href="{{ route('kamus.beranda') }}">Beranda</a>
                    </li>
                    <li class="nav-item">
                        <span class="nav-link disabled" title="Segera hadir">Materi Belajar</span>
                    </li>
                    <li class="nav-item">
                        <span class="nav-link disabled" title="Segera hadir">Kuis Evaluasi</span>
                    </li>
                    <li class="nav-item d-none d-lg-block"><span class="nav-pemisah"></span></li>
                    <li class="nav-item">
                        <a class="nav-link nav-admin" href="{{ route('admin.kata.index') }}">Admin</a>
                    </li>
                </ul>
                <a href="#" class="btn btn-masuk ms-lg-3">Masuk</a>
            </div>
        </div>
    </nav>
 
    <main class="container my-4">
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
 
        @yield('content')
    </main>
 
    <footer class="footer-kamus mt-5 py-4">
        <div class="container d-flex flex-column flex-md-row justify-content-between align-items-center text-center text-md-start gap-2">
            <div>
                <strong>Kamus Anggah-Ungguh Kruna Basa Bali</strong>
            </div>
            <div class="small">
                &copy; {{ date('Y') }} Kamus App. Seluruh hak cipta dilindungi.
            </div>
        </div>
    </footer>
 
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    @yield('scripts')
</body>
</html>
