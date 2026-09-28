@extends('layouts.app')
 
@section('title', 'Kamus Anggah-Ungguh Kruna Basa Bali')
 
@section('content')
    <div class="hero-kamus text-center">
        <p class="hero-kicker">Kamus Bahasa Bali&ndash;Indonesia</p>
        <h1 class="hero-judul">Anggah-Ungguh Kruna Basa Bali</h1>
        <p class="hero-sub">Ayo temukan kata dengan tingkatan bahasa Bali dan belajar tingkatan bahasa Bali dengan mudah!</p>
 
        <x-cari-kata class="form-cari justify-content-center" />
    </div>
@endsection
