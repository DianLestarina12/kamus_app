@extends('template')
@section('content')
    <form action="{{ route('soal.store') }}" method="POST">
        @csrf
        <input type="text" name="soal" placeholder="Masukkan Soal">
        <input type="text" name="jawaban" placeholder="Masukkan Jawaban">
        <button type="submit">Submit</button> 
    </form>
@section