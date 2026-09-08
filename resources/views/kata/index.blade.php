@extends('template')
@section('content')
    <div class="">
        <a class="btn" href="{{ route('kata.create') }}"> <div class="btn"> Add New Kata</div></a>
        <table class="table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Kata</th>
                    <th>Arti</th>
                    <th>Aksi</th>
                    <th>Aksi</th>
                    <th>Aksi</th>
                    <th>Aksi</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($katas as $kata)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $kata->kruna_andap }}</td>
                        <td>{{ $kata->kruna_asi }}</td>
                        <td>{{ $kata->kruna_aso }}</td>
                        <td>{{ $kata->kruna_ami }}</td>
                        <td>{{ $kata->kruna_mider }}</td>
                        <td>{{ $kata->kruna_kasar }}</td>
                        <td>{{ $kata->bahasa_indonesia }}</td>
                    </tr>
                @endforeach
            </tbody>
    </div>
@endsection
