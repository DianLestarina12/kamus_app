@extends('layouts.app')

@section('title', 'Kuis Evaluasi - Kamus Anggah-Ungguh Kruna Basa Bali')

@section('content')
    <div class="kuis-pembuka text-center">
        @if (session('error'))
            <div class="alert alert-warning">{{ session('error') }}</div>
        @endif

        <p class="kuis-pembuka-teks">
            Ayo coba kuis berikut untuk mengukur pengetahuan kamu tentang anggah-ungguh kruna basa Bali!
            Tapi sebelum itu harus mempelajari kata dan materi belajar.
        </p>

        <form method="POST" action="{{ route('kuis.mulai') }}">
            @csrf
            <button type="submit" class="btn btn-masuk btn-kuis">Kuis Evaluasi</button>
        </form>
    </div>
@endsection
