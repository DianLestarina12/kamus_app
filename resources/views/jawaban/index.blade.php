@extends('template')
@section('content')
    <div class="">
        <a class="btn" href="{{ route('jawaban.create') }}"> <div class="btn"> Add New Jawaban</div></a>
        <table class="table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Id_Soal</th>
                    <th>Jawaban</th>
                    <th>True False</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($jawabans as $jawaban)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $jawaban->id_soal }}</td>
                        <td>{{ $jawaban->jawaban }}</td>
                        <td>{{ $jawaban->true_false }}</td>
                    </tr>
              </tr>
                @endforeach
            </tbody>
    </div>
@endsection