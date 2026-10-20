@extends('layouts.app')

@section('title', 'Hasil Kuis Evaluasi - Kamus Anggah-Ungguh Kruna Basa Bali')

@section('content')
    <div class="kuis-kotak kuis-hasil text-center">
        <h1 class="kuis-hasil-judul">KUIS SELESAI!</h1>
        <p class="kuis-hasil-sub">Berikut hasil kuis belajarmu</p>

        <div class="kuis-statistik">
            <div class="kuis-statistik-item">
                <span class="kuis-statistik-label">Skor</span>
                <span class="kuis-statistik-nilai">{{ $hasil['skor'] }}</span>
            </div>
            <div class="kuis-statistik-item">
                <span class="kuis-statistik-label">Benar</span>
                <span class="kuis-statistik-nilai">{{ $hasil['benar'] }}</span>
            </div>
            <div class="kuis-statistik-item">
                <span class="kuis-statistik-label">Salah</span>
                <span class="kuis-statistik-nilai">{{ $hasil['salah'] }}</span>
            </div>
        </div>

        <div class="kuis-hasil-aksi">
            <form method="POST" action="{{ route('kuis.mulai') }}">
                @csrf
                <button type="submit" class="btn btn-selanjutnya-kuis">Ulangi</button>
            </form>
            <a href="{{ route('kamus.beranda') }}" class="btn btn-selanjutnya-kuis">Beranda</a>
        </div>
    </div>
@endsection
