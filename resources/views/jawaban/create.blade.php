@extends('template')
@section('content')
    <form action="{{ route('jawaban.store') }}" method="POST">
        @csrf
        <input type="text" name="id_soal" placeholder="Masukkan Id_Soal">
        <input type="text" name="jawaban" placeholder="Masukkan Jawaban">
        <input type="text" name="true_false" placeholder="Masukkan True False">
        <button type="submit">Submit</button> 
    </form>
@endsection