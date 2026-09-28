@extends('layouts.app')
 
@section('title', $kata->bentukUtama($tingkatan) . ' - Kamus Anggah-Ungguh Kruna Basa Bali')
 
@section('content')
    <div class="detail-kepala">
        <div>
            <h1 class="detail-kata">{{ $kata->bentukUtama($tingkatan) }}</h1>
            <p class="detail-arti">Bahasa Indonesia : {{ $kata->bahasa_indonesia }}</p>
        </div>
 
        <x-cari-kata placeholder="Cari Kata Lainnya" />
    </div>
 
    <div class="tabel-anggah">
        <div class="tabel-anggah-kepala">
            <span>Anggah-Ungguh Kruna Basa Bali</span>
            <span>Tingkatan Bahasa</span>
        </div>
 
        @foreach (\App\Models\Katas::tingkatanKeys() as $kolom)
            <div class="tabel-anggah-baris {{ $kolom === $tingkatan ? 'aktif' : '' }}">
                <span class="tabel-anggah-label">{{ \App\Models\Katas::tingkatanLabel($kolom, true) }}</span>
                <span class="tabel-anggah-nilai {{ blank($kata->{$kolom}) ? 'kosong' : '' }}">
                    {{ filled($kata->{$kolom}) ? $kata->{$kolom} : '- Tidak Tersedia' }}
                </span>
            </div>
        @endforeach
 
        <div class="tabel-anggah-baris">
            <span class="tabel-anggah-label">Bahasa Indonesia</span>
            <span class="tabel-anggah-nilai">{{ $kata->bahasa_indonesia }}</span>
        </div>
    </div>
 
    <div class="detail-kaki">
        @if ($kata->sinonim->isNotEmpty() || $kata->homonim->isNotEmpty())
            <div class="panel-terkait">
                <h2 class="panel-terkait-judul">
                    Pencarian Kata Terkait
                    <span class="badge-terkait">Sinonim &amp; Homonim</span>
                </h2>
 
                <div class="panel-terkait-isi">
                    @foreach (['sinonim' => 'Sinonim', 'homonim' => 'Homonim'] as $tipe => $labelTipe)
                        @foreach ($kata->{$tipe} as $terkait)
                            <a class="kartu-terkait" href="{{ route('kamus.detail', ['kata' => $terkait, 'tingkatan' => $terkait->pivot->tingkatan]) }}">
                                <span class="kartu-terkait-tipe">{{ strtoupper($labelTipe) }}</span>
                                <span class="kartu-terkait-kata">{{ $terkait->bentukUtama($terkait->pivot->tingkatan) }}</span>
                                <span class="kartu-terkait-meta">Anggah-ungguh Kruna : {{ \App\Models\Katas::tingkatanLabel($terkait->pivot->tingkatan) ?? 'Tidak ditentukan' }}</span>
                                <span class="kartu-terkait-meta">Terjemahan bahasa Indonesia : {{ $terkait->bahasa_indonesia }}</span>
                            </a>
                        @endforeach
                    @endforeach
                </div>
            </div>
        @else
            <div></div>
        @endif
 
        @if ($berikutnya)
            <a class="btn btn-selanjutnya" href="{{ route('kamus.detail', $berikutnya) }}">Selanjutnya</a>
        @endif
    </div>
@endsection
