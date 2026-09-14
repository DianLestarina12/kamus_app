@extends('template')

@section('content')
    <h1>Import Kata dari CSV</h1>

    <p>Format file CSV: baris pertama adalah header, baris berikutnya satu kata per baris, dengan urutan kolom:</p>
    <p><code>kata_asi,kata_aso,kata_ami,kata_mider,alus_sor,bahasa_indonesia</code></p>
    <p>Kolom <code>kata_asi</code> dan <code>bahasa_indonesia</code> wajib diisi, kolom lainnya boleh kosong. Kata yang sudah ada di kamus akan dilewati.</p>

    <form method="POST" action="{{ route('kata.import') }}" enctype="multipart/form-data">
        @csrf

        <label for="file">File CSV</label>
        <input type="file" name="file" id="file" accept=".csv,text/csv">
        @error('file')
            <div class="error">{{ $message }}</div>
        @enderror

        <button type="submit">Import</button>
        <a href="{{ route('kata.index') }}">Kembali</a>
    </form>
@endsection