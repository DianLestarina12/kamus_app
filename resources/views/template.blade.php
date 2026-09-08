<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">   
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Libre+Baskerville:ital,wght@0,400..700;1,400..700&display=swap" rel="stylesheet">
</head>
<style>
    .container {
        max-width: 80%;
        margin: 20px auto;
        background-color: #f8f9fa;
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
    }
</style>
<body style="justify-content: center; align-items: center;">
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container-fluid spc-container-navbar">
        <a class="navbar-brand" href="#">KAMUS ANGGAH-UNGGUH <br>
KRUNA BASA BALI</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
        <div class="navbar-nav spc-navbar">
            <a class="nav-link active" aria-current="page" href="#">Beranda</a>
            <a class="nav-link" href="#">Materi Belajar</a>
            <a class="nav-link" href="#">Kuis Evaluasi</a>
            <a class="nav-link" href="#">Tentang</a>
            <span class="nav-link disabled"> | </span>
            <a class="nav-link disabled" aria-disabled="true"> <u>Admin</u> </a>
            <a class="nav-link btn spc-btn btn-success">Masuk</a>
        </div>
        </div>
    </div>
    </nav>
    <div class="container">
        @yield('content')
    </div>
</body>
</html>