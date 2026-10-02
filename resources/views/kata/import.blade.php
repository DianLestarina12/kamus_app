@extends('template')

@section('content')
    <h1>Import Kata dari CSV</h1>

    <p>Format file CSV: baris pertama adalah header, baris berikutnya satu kata per baris, dengan urutan kolom:</p>
    <p><code>kruna_andap,kruna_asi,kruna_aso,kruna_ami,kruna_mider,kruna_kasar,bahasa_indonesia</code></p>
    <p>Kolom <code>kruna_andap</code> dan <code>bahasa_indonesia</code> wajib diisi, kolom lainnya boleh kosong. Kata yang sudah ada di kamus akan dilewati.</p>

    <form method="POST" action="{{ route('admin.kata.import') }}" enctype="multipart/form-data">
        @csrf

        <label for="file">File CSV</label>
        <input type="file" name="file" id="file" accept=".csv,text/csv">
        @error('file')
            <div class="error">{{ $message }}</div>
        @enderror

        <button type="submit">Import</button>
        <a href="{{ route('admin.kata.index') }}">Kembali</a>
    </form>
@endsection