@extends('template')

@section('content')
<style>
    .tentang-title {
        font-family: 'Libre Baskerville', serif;
        font-weight: 700;
        font-size: 1.8rem;
        color: #000;
        text-align: center;
        margin-bottom: 30px;
    }
    .bio-text {
        text-align: justify;
        line-height: 1.6;
        color: #333;
        font-size: 1.05rem;
    }
    .author-img {
        width: 100%;
        max-width: 250px;
        border-radius: 8px;
        object-fit: cover;
    }
    .card-kamus {
        background-color: #FDF9F3;
        border: 1px solid #D1BFAe;
        border-radius: 12px;
        padding: 20px;
        height: 100%;
    }
    .card-kamus-title {
        font-family: 'Libre Baskerville', serif;
        font-weight: bold;
        font-size: 1.1rem;
        text-align: center;
        margin-bottom: 20px;
        color: #333;
    }
    .book-img {
        width: 100%;
        border-radius: 4px;
        box-shadow: 0 4px 8px rgba(0,0,0,0.1);
    }
</style>

<div class="mt-4 mb-5">
    <h1 class="tentang-title">BIODATA PENULIS KAMUS</h1>

    <!-- Bagian Biodata -->
    <div class="row mb-5 align-items-center">
        <div class="col-md-3 text-center mb-3 mb-md-0">
            
            <!-- 👇 LOKASI GAMBAR PENULIS 👇 -->
            <img src="{{ asset('images/Foto-Prof-Suwija.jpeg') }}" alt="Prof. Dr. Drs. I Nyoman Suwija" class="author-img">
            
        </div>
        <div class="col-md-9">
            <p class="bio-text">
                Prof. Dr. Drs. I Nyoman Suwija, M.Hum., lahir di Badung pada tanggal 31 Desember 1963, merupakan seorang akademisi dengan jabatan Profesor yang mendedikasikan hidupnya pada bidang keahlian Ilmu Bahasa dan Sastra Bali. Beliau telah menyelesaikan pendidikan hingga jenjang S3 (Doktor) dan saat ini aktif mengabdi sebagai Dosen Pegawai Negeri Sipil (PNS) di bawah naungan LLDikti Wilayah VIII, yang dipekerjakan (dpk) pada Universitas PGRI Mahadewa Indonesia. Beliau menulis beberapa buku, termasuk buku yang digunakan sebagai data pada website ini yaitu Kamus Anggah-Ungguhing Basa Bali yang diterbitkan pada tahun 2008 dan Kamus Anggah-Ungguh Kruna Bali - Indonesia dan Indonesia - Bali yang diterbitkan tahun 2018.
            </p>
        </div>
    </div>

    <!-- Bagian Kamus -->
    <div class="row">
        <div class="col-md-6 mb-4">
            <div class="card-kamus">
                <div class="card-kamus-title">Kamus Anggah-Ungguhing Basa Bali (2008)</div>
                <div class="row">
                    <div class="col-6">
                        <!-- 👇 GAMBAR COVER DEPAN BUKU 1 👇 -->
                        <img src="{{ asset('images/Kamus-Prof-1.jpeg') }}" class="book-img" alt="Cover Depan 2008">
                    </div>
                    <div class="col-6">
                        <!-- 👇 GAMBAR COVER BELAKANG BUKU 1 👇 -->
                        <img src="{{ asset('images/Riwayat-Urip-Pangripta-Kamus-1.jpeg') }}" class="book-img" alt="Cover Belakang 2008">
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6 mb-4">
            <div class="card-kamus">
                <div class="card-kamus-title">Kamus Anggah-Ungguh Kruna Bali - Indonesia dan<br>Indonesia - Bali (2018)</div>
                <div class="row">
                    <div class="col-6">
                        <!-- 👇 GAMBAR COVER DEPAN BUKU 2 👇 -->
                        <img src="{{ asset('images/Kamus-Prof-2.jpeg') }}" class="book-img" alt="Cover Depan 2018">
                    </div>
                    <div class="col-6">
                        <!-- 👇 GAMBAR COVER BELAKANG BUKU 2 👇 -->
                        <img src="{{ asset('images/Riwayat-Urip-Pangripta-Kamus-2.jpeg') }}" class="book-img" alt="Cover Belakang 2018">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection