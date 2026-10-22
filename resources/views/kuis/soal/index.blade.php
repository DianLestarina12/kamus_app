@extends('template')
@section('content')
    <div class="">
        <a class="btn" href="{{ route('soal.create') }}"> <div class="btn"> Add New Soal</div></a>
        <table class="table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Soal</th>
                    <th>Jawaban</th>
                    <th>Opsi 1</th>
                    <th>Opsi 2</th>
                    <th>Opsi 3</th>
                    <th>Opsi 4</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($soals as $soal)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $soal->soal }}</td>
                        <td>{{ $soal->jawaban }}</td>
                        <td>{{ $soal->opsi1 }}</td>
                        <td>{{ $soal->opsi2 }}</td>
                        <td>{{ $soal->opsi3 }}</td>
                        <td>{{ $soal->opsi4 }}</td>
                        <td>
                            <a class="btn btn-sm btn-primary" href="{{ route('soal.edit', $soal->id) }}">Edit</a>
                            <form action="{{ route('soal.destroy', $soal->id) }}" method="POST" style="display: inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus soal ini?')">Hapus</button>
                            </form>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
