@extends('template')
@section('content')
    <form action="{{ route('soal.update', $soal->id) }}" method="POST">
        @csrf
        <input type="text" name="soal" placeholder="Masukkan Soal" value="{{ $soal->soal }}">
        <input type="text" name="jawaban" placeholder="Masukkan Jawaban" value="{{ $soal->jawaban }}">
        <input type="text" name="opsi1" placeholder="Masukkan Opsi" value="{{ $soal->opsi1 }}">
        <input type="text" name="opsi2" placeholder="Masukkan Opsi" value="{{ $soal->opsi2 }}">
        <input type="text" name="opsi3" placeholder="Masukkan Opsi" value="{{ $soal->opsi3 }}">
        <input type="text" name="opsi4" placeholder="Masukkan Opsi" value="{{ $soal->opsi4 }}">
        <button type="submit">Submit</button> 
    </form>
@endsection