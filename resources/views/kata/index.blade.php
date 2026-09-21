@extends('template')
@section('content')
<form method="GET" action="{{ route('kata.index') }}" class="mb-3">
    <div class="input-group" style="max-width: 420px;">
        <span class="input-group-text bg-white"><i class="bi bi-search"></i></span>
        <input type="text" name="q" value="{{ $search }}" class="form-control" placeholder="Cari kata...">
        <button type="submit" class="btn btn-oranye">Cari</button>
    </div>
</form>

        @php
            $columns = [
                'kruna_andap' => 'Kata Andap',
                'kruna_asi' => 'Kata Asi',
                'kruna_aso' => 'Kata Aso',
                'kruna_ami' => 'Kata Ami',
                'kruna_mider' => 'Kata Mider',
                'kruna_kasar' => 'Kata Kasar',
                'bahasa_indonesia' => 'Bahasa Indonesia',
            ];
        @endphp

<div class="table-responsive card-kamus p-2 shadow-sm">
    <table class="table table-kamus table-striped table-hover align-middle mb-0"> 
    <thead>
    <tr>
        <th>No</th>
        @foreach ($columns as $field => $label)
            @php
                $nextDirection = ($sort === $field && $direction === 'asc') ? 'desc' : 'asc';
            @endphp
            <th>
                <a style="text-decoration:none; color: black;" href="{{ route('kata.index', array_filter(['q' => $search, 'sort' => $field, 'direction' => $nextDirection])) }}">
                    {{ $label }}
                    @if ($sort === $field)
                        {{ $direction === 'asc' ? '▲' : '▼' }}
                    @endif
                </a>
            </th>
        @endforeach
        <th>Aksi</th>
    </tr>

                <!-- <tr>
                    <th>No</th>
                    <th>Kruna Andap</th>
                    <th>Kruna Alus Singgih</th>
                    <th>Kruna Alus Sor</th>
                    <th>Kruna Alus Mider</th>
                    <th>Kruna Mider</th>
                    <th>Kruna Kasar</th>
                    <th>Bahasa Indonesia</th>
                    <th>Aksi</th>
                </tr> -->
            </thead>
            <tbody>

                @foreach ($katas as $index => $kata)
                    <tr>
                       <td>{{ $index + 1 }}</td>
                        <td>{{ $kata->kruna_andap }}</td>
                        <td>{{ $kata->kruna_asi }}</td>
                        <td>{{ $kata->kruna_aso }}</td>
                        <td>{{ $kata->kruna_ami }}</td>
                        <td>{{ $kata->kruna_mider }}</td>
                        <td>{{ $kata->kruna_kasar }}</td>
                        <td>{{ $kata->bahasa_indonesia }}</td>
                        <td>
                        <button type="button" class="edit-btn btn btn-sm btn-outline-coklat m-1"
                            data-id="{{ $kata->id }}"
                            data-action="{{ route('kata.update', $kata) }}"
                            data-kruna_andap="{{ $kata->kruna_andap }}"
                            data-kruna_asi="{{ $kata->kruna_asi }}"
                            data-kruna_aso="{{ $kata->kruna_aso }}"
                            data-kruna_ami="{{ $kata->kruna_ami }}"
                            data-kruna_mider="{{ $kata->kruna_mider }}"
                            data-kruna_kasar="{{ $kata->kruna_kasar }}"
                            data-bahasa_indonesia="{{ $kata->bahasa_indonesia }}">Edit</button>

                           <form action="{{ route('kata.destroy', $kata->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger" class="bi bi-trash3" onclick="return confirm('Are you sure?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
    </table>
</div>



<div class="modal fade modal-kamus" id="editModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="POST" id="editForm">
                @csrf
                @method('PUT')
                <input type="hidden" name="_kata_id" id="edit_kata_id">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Kata</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                   <form method="POST" id="editForm">
            @csrf
            @method('PUT')
            <input type="text" name="kata_id" id="edit_kruna_id" hidden>
            @error('kata_id')
                <div class="error">{{ $message }}</div>
            @enderror

            <label for="edit_kruna_andap">Kata Andap</label>
            <input type="text" name="kata_andap" id="edit_kruna_andap">
            @error('kata_andap')
                <div class="error">{{ $message }}</div>
            @enderror

            <label for="edit_kruna_asi">Kata Alus Singgih</label>
            <input type="text" name="kata_asi" id="edit_kruna_asi">
            @error('kata_asi')
                <div class="error">{{ $message }}</div>
            @enderror

            <label for="edit_kruna_aso">Kata Alus Sor</label>
            <input type="text" name="kata_aso" id="edit_kruna_aso">
            @error('kata_aso')
                <div class="error">{{ $message }}</div>
            @enderror

            <label for="edit_kruna_ami">Kata Alus Mider</label>
            <input type="text" name="kata_ami" id="edit_kruna_ami">
            @error('kata_ami')
                <div class="error">{{ $message }}</div>
            @enderror

            <label for="edit_kruna_mider">Kata Mider</label>
            <input type="text" name="kata_mider" id="edit_kruna_mider">
            @error('kata_mider')
                <div class="error">{{ $message }}</div>
            @enderror

            <label for="edit_kruna_kasar">Kasar</label>
            <input type="text" name="kata_kasar" id="edit_kruna_kasar">
            @error('kata_kasar')
                <div class="error">{{ $message }}</div>
            @enderror

            <label for="edit_bahasa_indonesia">Bahasa Indonesia</label>
            <textarea name="bahasa_indonesia" id="edit_bahasa_indonesia" rows="4"></textarea>
            @error('bahasa_indonesia')
                <div class="error">{{ $message }}</div>
            @enderror

            <button type="submit">Simpan Perubahan</button>
            <button type="button" id="editModalClose">Batal</button>
        </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-coklat" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-oranye">Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
    const editModalEl = document.getElementById('editModal');
    const editModal = new bootstrap.Modal(editModalEl);
    const editForm = document.getElementById('editForm');

    function openEditModal(data) {
        editForm.action = data.action;
        editForm.querySelector('#edit_kata_id').value = data.id ?? '';
        // editForm.querySelector('#edit_kruna_id').value = data.id ?? '';
        editForm.querySelector('#edit_kruna_andap').value = data.kruna_andap ?? '';
        editForm.querySelector('#edit_kruna_asi').value = data.kruna_asi ?? '';
        editForm.querySelector('#edit_kruna_aso').value = data.kruna_aso ?? '';
        editForm.querySelector('#edit_kruna_ami').value = data.kruna_ami ?? '';
        editForm.querySelector('#edit_kruna_mider').value = data.kruna_mider ?? '';
        editForm.querySelector('#edit_kruna_kasar').value = data.kruna_kasar ?? '';
        editForm.querySelector('#edit_bahasa_indonesia').value = data.bahasa_indonesia ?? '';
        editModal.show();
    }

    document.querySelectorAll('.edit-btn').forEach((btn) => {
        btn.addEventListener('click', () => openEditModal(btn.dataset));
    });
</script>
@endsection