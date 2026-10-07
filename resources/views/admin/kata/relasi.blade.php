@extends('template')
@section('content')

<div class="d-flex justify-content-between align-items-start mb-4 mt-3">
    <div>
        <h4 class="mb-1 mt-2" style="color: black; font-weight: bold; font-family: 'Libre Baskerville', serif;">
            HOMONIM: {{ $kata->bentukUtama() }}
        </h4>
        <p class="mb-0 text-muted">Bahasa Indonesia : {{ $kata->bahasa_indonesia }}</p>
    </div>
    <a href="{{ route('admin.kata.index') }}" class="btn btn-outline-coklat mt-2">Kembali</a>
</div>

@if (session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

@if ($errors->any())
    <div class="alert alert-danger">
        @foreach ($errors->all() as $error)
            <div>{{ $error }}</div>
        @endforeach
    </div>
@endif

<div class="card-kamus p-3 shadow-sm mb-4">
    <h5 class="mb-3">Tambah Homonim</h5>
    <form method="POST" action="{{ route('admin.kata.relasi.store', $kata) }}" class="row g-3 align-items-end">
        @csrf
        <div class="col-md-6">
            <label for="kata_terkait_id" class="form-label">Kata</label>
            <select name="kata_terkait_id" id="kata_terkait_id" class="form-select" required>
                <option value="">Pilih kata</option>
                @foreach ($pilihan as $item)
                    <option value="{{ $item->id }}" @selected(old('kata_terkait_id') == $item->id)>
                        {{ $item->bentukUtama() }} ({{ $item->bahasa_indonesia }})
                    </option>
                @endforeach
            </select>
        </div>
        <div class="col-md-4">
            <label for="tingkatan" class="form-label">Tingkatan</label>
            <select name="tingkatan" id="tingkatan" class="form-select">
                <option value="">Tidak ditentukan</option>
                @foreach (\App\Models\Katas::tingkatanKeys() as $key)
                    <option value="{{ $key }}" @selected(old('tingkatan') === $key)>
                        {{ \App\Models\Katas::tingkatanLabel($key, true) }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="col-md-2">
            <button type="submit" class="btn w-100" style="background-color: #F4A259; color: white; font-weight: bold;">Tambah</button>
        </div>
    </form>
</div>

<div class="table-responsive card-kamus p-2 shadow-sm">
    <table class="table-custom">
        <thead>
            <tr>
                <th>Kata</th>
                <th>Tingkatan</th>
                <th>Bahasa Indonesia</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($kata->homonim as $terkait)
                <tr>
                    <td>{{ $terkait->bentukUtama($terkait->pivot->tingkatan) }}</td>
                    <td>{{ \App\Models\Katas::tingkatanLabel($terkait->pivot->tingkatan) ?? 'Tidak ditentukan' }}</td>
                    <td>{{ $terkait->bahasa_indonesia }}</td>
                    <td>
                        <form action="{{ route('admin.kata.relasi.destroy', [$kata, 'homonim', $terkait]) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Hapus relasi ini?')">Hapus</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" class="text-center text-muted">Belum ada homonim. Sinonim ditentukan otomatis dari arti bahasa Indonesia yang sama.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

@endsection
