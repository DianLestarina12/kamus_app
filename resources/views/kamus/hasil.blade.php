@extends('layouts.app')
 
@section('title', 'Hasil pencarian "' . $search . '"')
 
@section('content')
    <x-cari-kata :nilai="$search" class="form-cari mb-4" />
 
    <h1 class="hasil-judul">Hasil dari pencarian kata &ldquo;{{ $search }}&rdquo;</h1>
 
    @forelse ($grup as $huruf => $daftar)
        <h2 class="hasil-huruf">{{ $huruf }}</h2>
 
        @foreach ($daftar as $item)
            <a class="hasil-item" href="{{ route('kamus.detail', ['kata' => $item['kata'], 'tingkatan' => $item['tingkatan'], 'q' => $search]) }}">
                <span class="hasil-bentuk">
                    @if ($item['cocok_arti'])
                        {{ $item['bentuk'] }}
                        <span class="hasil-arti">&mdash; <strong>{{ $item['kata']->bahasa_indonesia }}</strong></span>
                    @else
                        <x-sorot :teks="$item['bentuk']" :cari="$search" />
                        <span class="hasil-arti">&mdash; {{ $item['kata']->bahasa_indonesia }}</span>
                    @endif
                </span>
                <span class="badge-tingkatan">{{ \App\Models\Katas::tingkatanLabel($item['tingkatan']) }}</span>
            </a>
        @endforeach
    @empty
        <div class="hasil-kosong">
            <i class="bi bi-search"></i>
            <p class="mb-1">Kata &ldquo;{{ $search }}&rdquo; tidak ditemukan di kamus.</p>
            <p class="text-muted small mb-0">Coba gunakan ejaan lain atau kata yang lebih pendek.</p>
        </div>
    @endforelse
@endsection
