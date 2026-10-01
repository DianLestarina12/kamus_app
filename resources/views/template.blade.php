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
   /* .container {
        max-width: 90%;
        margin: 10px auto;
        background-color: #f8f9fa;
        padding: 20px;
        border-radius: 5px;
        
    }
   /* .spc-container-navbar {
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
    }*/
/*code baru*/

    /* Kunci wadah navbar dengan tinggi tetap dan border atas-bawah */
.navbar-kamus {
    background-color: #FFFFFF;
    border-top: 1px solid #6E491C;
    border-bottom: 1px solid #6E491C;
    height: 70px !important;
    padding: 0 !important;
    display: flex;
    align-items: center;
}

/* Hilangkan margin/padding teks logo dan kunci jarak barisnya */
.navbar-brand {
    font-family: 'Libre Baskerville', serif;
    font-size: 15px !important;
    font-weight: bold;
    color: #6E491C !important;
    line-height: 1.3 !important;
    margin: 0 !important;
    padding: 0 !important;
}

/* Atur jarak antar teks menu menjadi seragam */
.navbar-nav {
    display: flex;
    align-items: center;
    gap: 20px;
}

.nav-link {
    color: #6E491C !important;
    font-weight: 500;
    font-size: 14.5px;
    padding: 0 !important; 
    margin: 0 !important;
}

/* Garis bawah menu Admin */
.nav-admin-active {
    text-decoration: underline !important;
    text-underline-offset: 5px;
    text-decoration-thickness: 1.5px;
}

/* Garis vertikal pembatas */
.nav-separator {
    border-left: 1.5px solid #6E491C;
    height: 18px;
    margin: 0 5px;
}

/* Kustomisasi tombol Masuk */
.btn-masuk {
    background-color: #6E491C;
    color: #FFFFFF;
    font-weight: 600;
    border-radius: 4px;
    padding: 7px 22px !important;
    font-size: 14.5px;
    border: none;
    margin-left: 20px;
}
.btn-masuk:hover {
    background-color: #523614;
    color: #FFFFFF;
}

/* Pewarnaan tabel */
/* Gaya Wadah Tabel Utama */
.table-custom {
    border-collapse: separate;
    border-spacing: 0;
    border: 1px solid #6E491C !important; /* Ketebalan border 2px */
    border-radius: 10px; 
    overflow: hidden;
    width: 100%;
    text-align: center;
    margin-top: 20px;
}

/* Gaya Header (Judul Kolom) */
.table-custom thead th {
    background-color: #EDCDA3 !important; /* Warna krem pastel */
    color: #000000;
    border-bottom: 1px solid #6E491C !important; /* Ketebalan border 2px */
    border-right: 1px solid #6E491C !important; /* Ketebalan border 2px */
    padding: 15px 10px;
    vertical-align: middle;
    font-weight: bold;
}

/* Gaya Isi Tabel (Baris Data) */
.table-custom tbody td {
    border-bottom: 1px solid #6E491C !important; /* Ketebalan border 2px */
    border-right: 1px solid #6E491C !important; /* Ketebalan border 2px */
    padding: 12px;
    vertical-align: middle;
}

/* Menghilangkan garis ganda di ujung kanan dan bawah */
.table-custom thead th:last-child,
.table-custom tbody td:last-child {
    border-right: none !important;
}
.table-custom tbody tr:last-child td {
    border-bottom: none !important;
}

/* Warna baris selang-seling (Zebra cross) */
.table-custom tbody tr:nth-child(even) {
    background-color: #FDF8F0 !important; /* Warna krem sangat muda */
}
.table-custom tbody tr:nth-child(odd) {
    background-color: #FFFFFF !important; /* Putih */
}

/* Styling khusus untuk isi Modal Tambah Kata */
    .modal-tambah-kata .modal-content {
        border-radius: 12px;
        border: none;
        box-shadow: 0 10px 30px rgba(0,0,0,0.15);
    }
    
    .modal-tambah-kata .modal-header {
        border-bottom: none;
        padding-bottom: 0;
    }
    
    .modal-tambah-kata .modal-title {
        font-weight: 800;
        font-size: 1.25rem;
        width: 100%;
        text-align: center;
        color: #1a1a1a;
    }

    .modal-tambah-kata .form-label {
        font-weight: 700;
        font-size: 0.9rem;
        margin-bottom: 4px;
        color: #000;
    }

    /* Styling input agar menyerupai tombol dropdown di desain */
    .modal-tambah-kata .form-control,
    .modal-tambah-kata .form-select {
        border: 1px solid #C4A484; /* Warna border cokelat muda */
        border-radius: 8px;
        padding: 10px 15px;
        color: #999; /* Warna teks placeholder */
        font-size: 0.95rem;
    }

    .modal-tambah-kata .form-control:focus,
    .modal-tambah-kata .form-select:focus {
        border-color: #6E491C;
        box-shadow: 0 0 0 0.2rem rgba(110, 73, 28, 0.25);
        color: #333;
    }
    
    /* Tombol Aksi */
    .modal-tambah-kata .btn-batal {
        background-color: #6E491C;
        color: white;
        border-radius: 6px;
        padding: 8px 25px;
        font-weight: 500;
        border: none;
    }
    
    .modal-tambah-kata .btn-simpan {
        background-color: #8C6239; /* Cokelat yang sedikit lebih terang */
        color: white;
        border-radius: 6px;
        padding: 8px 25px;
        font-weight: 500;
        border: none;
    }
    
    .modal-tambah-kata .modal-footer {
        border-top: none;
        justify-content: flex-end;
        gap: 10px;
        padding-top: 5px;
    }
</style>



<body style="">
<!--
   <nav class="navbar navbar-expand-lg navbar-kamus sticky-top">
    <div class="container">
        <!-- <a class="navbar-brand" href="{{ route('admin.kata.index') }}">
            <i class="bi bi-book-half"></i> Kamus App
        </a> 
        <a class="navbar-brand" href="#">KAMUS ANGGAH-UNGGUH <br> KRUNA BASA BALI</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarKamus">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarKamus">
            <ul class="navbar-nav ms-lg-auto align-items-lg-center mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('admin.kata.index') ? 'active' : '' }}" href="{{ route('admin.kata.index') }}">Beranda</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('admin.kata.create') || request()->routeIs('admin.kata.store') ? 'active' : '' }}" href="{{ route('admin.kata.create') }}">Materi Belajar</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('admin.kata.import*') ? 'active' : '' }}" href="{{ route('admin.kata.import.form') }}">Kuis Evaluasi</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link">Tentang</a>
                </li>
                <div class="d-none d-lg-block nav-separator"></div>
                
                <li class="nav-item">
                    <a class="nav-link nav-admin-active">Admin</a>
                </li>
            </ul>
            <a href="#" class="btn btn-login ms-lg-3">Masuk</a>
        </div>
    </div>
</nav
-->

<!--CODE BARU YEAHHH-->
<nav class="navbar navbar-kamus sticky-top">
    <div class="container d-flex justify-content-between align-items-center">
        
        <!-- Bagian Kiri: Logo Teks -->
        <a class="navbar-brand" href="#">
            KAMUS ANGGAH-UNGGUH<br>KRUNA BASA BALI
        </a>

        <!-- Bagian Kanan: Menu & Tombol -->
        <div class="d-flex align-items-center">
            <ul class="navbar-nav flex-row align-items-center mb-0">
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('admin.kata.index') ? 'active' : '' }}" href="{{ route('admin.kata.index') }}">Beranda</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('admin.kata.create') || request()->routeIs('admin.kata.store') ? 'active' : '' }}" href="{{ route('admin.kata.create') }}">Materi Belajar</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('admin.kata.import*') ? 'active' : '' }}" href="{{ route('admin.kata.import.form') }}">Kuis Evaluasi</a>
                </li>
                
                <!-- Garis Pemisah | -->
                <li class="nav-item d-flex align-items-center">
                    <div class="nav-separator"></div>
                </li>
                
                <li class="nav-item">
                    <a class="nav-link nav-admin-active" href="#">Admin</a>
                </li>
            </ul>
            
            <a href="#" class="btn btn-masuk">Masuk</a>
        </div>
        
    </div>
</nav>

    <div class="container px-2 mt-6">
        @yield('content')
        @yield('modal')
    </div>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
</html>