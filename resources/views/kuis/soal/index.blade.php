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
                </tr>
            </thead>
            <tbody>
                @foreach ($soals as $soal)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $soal->soal }}</td>
                        <td>{{ $soal->jawaban }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
