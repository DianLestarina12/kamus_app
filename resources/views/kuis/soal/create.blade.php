@extends('template')
@section('content')
    <h4 class="mt-3 mb-4">Tambah Soal</h4>
    <form action="{{ route('soal.store') }}" method="POST">
        @csrf
        @include('kuis.soal._form')
        <button type="submit" class="btn btn-primary">Simpan</button>
        <a href="{{ route('soal.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
@endsection
