@extends('template')

@section('content')
<style>
    /* Styling Khusus Halaman Materi */
    .materi-title {
        font-family: 'Libre Baskerville', serif;
        font-weight: 700;
        font-size: 2rem;
        color: #000;
        margin-bottom: 0.5rem;
    }
    
    .materi-subtitle {
        font-size: 1rem;
        color: #333;
        margin-bottom: 2rem;
        line-height: 1.5;
    }

    .materi-box {
        background-color: #FDF9F3; /* Warna earth-tone terang */
        border: 1px solid #D1BFAe;
        border-radius: 12px;
        padding: 25px;
    }

    /* Styling Sidebar */
    .materi-sidebar-header {
        font-weight: 700;
        font-size: 1.25rem;
        border-bottom: 1px solid #D1BFAe;
        padding-bottom: 15px;
        margin-bottom: 15px;
        color: #000;
    }

    .materi-menu {
        list-style: none;
        padding-left: 0;
        margin: 0;
    }

    .materi-menu > li {
        margin-bottom: 12px;
        font-size: 1.05rem;
        color: #333;
    }

    .materi-menu a {
        text-decoration: none;
        color: #333;
    }

    .materi-menu a:hover {
        color: #6E491C;
    }

    .materi-sub-title {
        margin-top: 15px;
        margin-bottom: 8px;
        text-decoration: underline;
        text-underline-offset: 4px;
        color: #333;
    }

    .materi-sub-menu {
        list-style-type: disc;
        padding-left: 20px;
        margin-bottom: 15px;
        font-size: 0.95rem;
    }
    
    .materi-sub-menu li {
        margin-bottom: 6px;
    }

    .menu-active {
        font-weight: 700;
        color: #000 !important;
    }

    /* Styling Konten Bacaan */
    .materi-content h3 {
        font-weight: 700;
        font-size: 1.4rem;
        margin-bottom: 15px;
        color: #000;
    }

    .materi-content p {
        text-align: justify;
        line-height: 1.6;
        margin-bottom: 15px;
        color: #333;
    }

    .materi-content ol {
        padding-left: 20px;
        margin-bottom: 15px;
        line-height: 1.6;
    }
</style>

<div class="mt-4 mb-5">
    <h1 class="materi-title">Materi Anggah-Ungguh Kruna Basa Bali</h1>
    <p class="materi-subtitle">
        Bahasa daerah Bali merupakan alat komunikasi yang masih hidup dan digunakan sebagai alat komunikasi intrasuku Bali. Berikut<br>merupakan materi belajar Anggah Ungguh Kruna basa Bali untuk lebih memahami cara penggunaan dan tingkatan bahasa Bali.
    </p>

    <div class="row align-items-stretch">
        
        <!-- KOLOM KIRI: Pilihan Materi -->
        <div class="col-lg-3 col-md-4 mb-4">
            <div class="materi-box">
                <div class="materi-sidebar-header">Pilihan Materi</div>
                <ul class="materi-menu">
                    <!-- Latar Belakang -->
                    <li>
                        <a href="{{ route('materi.latar_belakang') }}" class="{{ request()->routeIs('materi.latar_belakang') ? 'menu-active' : '' }}">Latar Belakang</a>
                    </li>
                    
                    <!-- Identifikasi (Rute belum ada di daftar Anda, dikosongkan sementara) -->
                    <li>
                        <a href="#">Identifikasi Anggah-Ungguh Kruna Basa Bali</a>
                    </li>
                    
                    <!-- Kruna Alus -->
                    <div class="materi-sub-title">
                        <a href="{{ route('materi.kruna_alus') }}" class="{{ request()->routeIs('materi.kruna_alus') ? 'menu-active' : '' }}">Kruna Alus</a>
                    </div>
                    <ul class="materi-sub-menu">
                        <li><a href="{{ route('materi.alus_singgih') }}" class="{{ request()->routeIs('materi.alus_singgih') ? 'menu-active' : '' }}">Kruna Alus Singgih (ASI)</a></li>
                        <li><a href="{{ route('materi.alus_sor') }}" class="{{ request()->routeIs('materi.alus_sor') ? 'menu-active' : '' }}">Kruna Alus Sor (ASO)</a></li>
                        <li><a href="{{ route('materi.alus_mider') }}" class="{{ request()->routeIs('materi.alus_mider') ? 'menu-active' : '' }}">Kruna Alus Mider (AMI)</a></li>
                        <li><a href="{{ route('materi.alus_madia') }}" class="{{ request()->routeIs('materi.alus_madia') ? 'menu-active' : '' }}">Kruna Alus Madya</a></li>
                    </ul>

                    <!-- Kruna Nenten Alus -->
                    <div class="materi-sub-title">
                        <a href="{{ route('materi.kruna_nenten_alus') }}" class="{{ request()->routeIs('materi.kruna_nenten_alus') ? 'menu-active' : '' }}">Kruna Nenten Alus</a>
                    </div>
                    <ul class="materi-sub-menu">
                        <li><a href="{{ route('materi.kruna_mider') }}" class="{{ request()->routeIs('materi.kruna_mider') ? 'menu-active' : '' }}">Kruna Mider</a></li>
                        <li><a href="{{ route('materi.kruna_andap') }}" class="{{ request()->routeIs('materi.kruna_andap') ? 'menu-active' : '' }}">Kruna Andap</a></li>
                        <li><a href="{{ route('materi.kruna_kasar') }}" class="{{ request()->routeIs('materi.kruna_kasar') ? 'menu-active' : '' }}">Kruna Kasar</a></li>
                    </ul>
                    <li>
                        <a href="{{ route('materi.kesimpulan') }}" class="{{ request()->routeIs('materi.kesimpulan') ? 'menu-active' : '' }}">Kesimpulan</a>
                    </li>
                </ul>
            </div>
        </div>

        <!-- KOLOM KANAN: Isi Materi Dinamis -->
        <div class="col-lg-9 col-md-8 mb-4">
            <div class="materi-box materi-content">
                
                <!-- LOGIKA PINTAR: Jika ada materi lain yang dipanggil (seperti kruna alus), tampilkan materinya. 
                     Jika halaman baru dibuka dan kosong, tampilkan Latar Belakang sebagai default -->
                @hasSection('isi_materi')
                    @yield('isi_materi')
                @else
                    <h3>Latar Belakang <em>Anggah-Ungguh Kruna</em></h3>

                    <p>
                        Stratifikasi atau status sosial masyarakat suku Bali tergolong unik karena dilihat dari segi kelahiran, 
                        ada keturunan bangsawan (<em>brahmana dan ksatria</em>), 
                        ada sisanya merupakan masyarakat orang kebanyakan yang terlahir dari masyarakat berkasta sudra yang dsebut <em>wangsa jaba</em>. 
                        Keturunan bangsawan atau orang-orang yang memiliki jabatan penting disebut <em>sang singgih</em> (golongan atas) dan mereka yang keturunan orang kebanyakan atau yang menjadi rakyat kecil disebut <em>sang sor</em> (golongan bawah). 
                        Hal inilah yang membawa konsekuensi terdapatnya sistem bicara bahasa Bali yang unik dengan <em>anggah-ungguh kruna</em>-nya.
                    </p>

                    <p>
                        Selanjutnya ketika masing-masing individu memasuki dunia kerja atau dunia industri, 
                        ada yang berkedudukan sebagai pejabat, ada pula yang menjadi pegawai kecil, pedagang, nlatan atau buruh lainnya. 
                        Orang-orang yang memiliki jabatan penting disebut <em>sang singgih</em> (golongan atas), sedangkan mereka yang menjadi rakyat atau pegawai kecil serta buruh-buruh pekerja kasar disebut <em>sang sor</em> (golongan bawah).
                    </p>

                    <p>
                        Status sosial inilah yang menyebabkan adanya tingkatan bicara dalam bahasa Bali. 
                        Masyarakat golongan bawah (<em>sang sor</em>) yang berbicara terhadap golongan atas (<em>sang singgih</em>) akan berbahasa Bali tingkatan <em>alus</em> (menghormat) dan sebaliknya masyarakat golongan atas (<em>sang singgih</em>) dapat berbahasa <em>andap</em> atau tingkatan biasa (lepas hormat) terhadap golongan bawah (<em>sang sor</em>). 
                        Dengan demikian muncullah tingkat-tingkatan bicara yang dalam bahasa Bali disebut <em>Anggah-Ungguhing Basa Bali</em>. 
                        Anggah-ungguh basa Bali dibentuk oleh kalimat-kalimat, dan kalimat dibentuk oleh kata-kata bahasa daerah Bali yang bervariasi yang disebut <em>anggah-ungguh kruna</em>.
                    </p>

                    <p>
                        Setiap kata bahasa Bali memiliki nilai rasa yang berbeda-beda. 
                        Keadaan kosakata bahasa Bali seperti itulah yang dirasakan menjadi penyebab sulitnya berkomunikasi dengan bahasa Bali. 
                        Kesulitan tersebut akan dapat diatasi jika dilakukan upaya serius untuk mempelajari kata demi kata, terurama kosakata yang memiliki bentuk halus. 
                        Berdasarkan nilai rasanya, secara umum kosakata bahasa Bali dibedakan atas kata atau <em>kruna alus</em> dan kata atau <em>kruna nenten alus</em>.
                    </p>
                @endif

    </div>
</div>
@endsection