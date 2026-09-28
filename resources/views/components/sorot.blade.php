@props(['teks', 'cari' => ''])
@php
    $posisi = $cari === '' ? false : mb_stripos($teks, $cari);
@endphp
@if ($posisi === false){{ $teks }}@else{{ mb_substr($teks, 0, $posisi) }}<strong>{{ mb_substr($teks, $posisi, mb_strlen($cari)) }}</strong>{{ mb_substr($teks, $posisi + mb_strlen($cari)) }}@endif
