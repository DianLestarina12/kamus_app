@extends('template')
@section('content')
    <h4 class="mt-3 mb-4">Edit Soal</h4>
    <form action="{{ route('soal.update', $soal->id) }}" method="POST">
        @csrf
        @method('PUT')
        @include('kuis.soal._form')
        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
        <a href="{{ route('soal.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
@endsection
