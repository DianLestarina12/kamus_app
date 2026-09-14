@extends('template')
@section('content')
    <div class="">


        <a class="btn" href="{{ route('kata.create') }}"> <div class="btn"> Add New Kata</div></a>
        <a class="btn" href="{{ route('kata.import') }}"> <div class="btn"> Import</div></a>
        <table class="table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Kruna Andap</th>
                    <th>Kruna Alus Singgih</th>
                    <th>Kruna Alus Sor</th>
                    <th>Kruna Alus Mider</th>
                    <th>Kruna Mider</th>
                    <th>Kruna Kasar</th>
                    <th>Bahasa Indonesia</th>
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
                        <td>
                                <!-- Button trigger modal -->
<a href="{{ route('kata.edit', $kata->id) }}" type="button" class="btn btn-primary">
  Edit
</a>
                           <form action="{{ route('kata.destroy', $kata->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>





@endsection


