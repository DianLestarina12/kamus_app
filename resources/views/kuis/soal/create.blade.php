@extends('template')
@section('content')
    <form action="{{ route('soal.store') }}" method="POST">
        @csrf
        <input type="text" name="soal" placeholder="Masukkan Soal">
        <input type="text" name="jawaban" placeholder="Masukkan Jawaban">
        <input type="text" name="opsi1" placeholder="Masukkan Opsi">
        <input type="text" name="opsi2" placeholder="Masukkan Opsi">
        <input type="text" name="opsi3" placeholder="Masukkan Opsi">
        <input type="text" name="opsi4" placeholder="Masukkan Opsi">
        <button type="submit">Submit</button> 
    </form>
@endsection