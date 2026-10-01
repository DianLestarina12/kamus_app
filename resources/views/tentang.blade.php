@extends('layouts.app')
 
@section('content')
    <div class="card-kamus p-4 p-md-5 shadow-sm">
        <h1 class="mb-3" style="color: var(--coklat);">Tentang Kamus App</h1>
        <p class="lead">
            Kamus App adalah kamus digital untuk membantu menerjemahkan kata dalam berbagai
            tingkatan basa (unggah-ungguh) Bahasa Bali &mdash; mulai dari kata kasar/mider
            hingga alus sor &mdash; ke Bahasa Indonesia.
        </p>
        <p>
            Setiap entri kata dicatat dalam beberapa bentuk sekaligus (kata asi, kata aso,
            kata ami, kata mider, alus sor) beserta padanan Bahasa Indonesianya, sehingga
            pengguna dapat memahami perbedaan tingkat kesopanan penggunaan kata dalam
            percakapan sehari-hari.
        </p>
        <hr class="my-4">
        <h2 class="h4" style="color: var(--coklat);">Fitur</h2>
        <ul>
            <li>Kelola data kata: tambah, ubah (lewat popup modal), dan hapus (soft delete).</li>
            <li>Pencarian kata di semua kolom sekaligus.</li>
            <li>Urutkan data tabel naik/turun berdasarkan kolom mana pun.</li>
            <li>Import data massal lewat file CSV.</li>
            <li>Sampah untuk memulihkan atau menghapus permanen data yang terhapus.</li>
        </ul>
        <a href="{{ route('kamus.beranda') }}" class="btn btn-oranye mt-2">Mulai Jelajahi Kamus</a>
    </div>
@endsection
