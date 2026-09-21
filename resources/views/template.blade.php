<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">   
     <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Libre+Baskerville:ital,wght@0,400..700;1,400..700&display=swap" rel="stylesheet">
</head>
<style>
    .container {
        max-width: 90%;
        margin: 10px auto;
        /* background-color: #f8f9fa; */
        padding: 20px;
        border-radius: 5px;
        
    }
    .spc-container-navbar {
        max-width: 80%;
        margin:  auto;
        background-color: #f8f9fa;
        padding: 20px;
        border-radius: 5px;
        padding-bottom: 0 !important;
    }
    .spc-navbar {
        margin-left: auto;
    }
    .spc-btn{
        background-color: #6E491C;
        color: white;
    }
    .navbar-brand{
        font-family: 'Libre Baskerville', serif;
        font-size: 18px;
        font-weight: bold;
        color: #6E491C;
    }
</style>



<body style="">
   <nav class="navbar navbar-expand-lg navbar-kamus sticky-top">
    <div class="container">
        <!-- <a class="navbar-brand" href="{{ route('kata.index') }}">
            <i class="bi bi-book-half"></i> Kamus App
        </a> -->
        <a class="navbar-brand" href="#">KAMUS ANGGAH-UNGGUH <br>
KRUNA BASA BALI</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarKamus">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarKamus">
            <ul class="navbar-nav ms-lg-auto align-items-lg-center mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('kata.index') ? 'active' : '' }}" href="{{ route('kata.index') }}">Daftar Kata</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('kata.create') || request()->routeIs('kata.store') ? 'active' : '' }}" href="{{ route('kata.create') }}">Tambah Kata</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('kata.import*') ? 'active' : '' }}" href="{{ route('kata.import.form') }}">Import CSV</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link">Sampah</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link">Tentang</a>
                </li>
            </ul>
            <a href="#" class="btn btn-login ms-lg-3">Login</a>
        </div>
    </div>
</nav>

    <div class="container">
        @yield('content')
        @yield('modal')
    </div>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
</html>