@extends('template')
@section('content')

<!-- 👇👇👇 MASUKKAN KODE BARU DI SINI 👇👇👇 -->
<div class="d-flex justify-content-between align-items-start mb-4 mt-3">
    
    <!-- Bagian Kiri: Judul Dashboard -->
    <h4 class="mb-0 mt-2" style="color: black; font-weight: bold; font-family: 'Libre Baskerville', serif;">
        DASHBOARD PENGELOLAAN <br> KATA OLEH ADMIN
    </h4>

    <!-- Bagian Kanan: Pencarian dan Tombol Tambah -->
    <div class="d-flex flex-column align-items-end gap-3">
        
        <!-- Baris 1: Kotak Pencarian -->
        <form method="GET" action="{{ route('admin.kata.index') }}" class="d-flex">
            <!-- Group Input (Teks & Ikon Kaca Pembesar) -->
            <div class="input-group shadow-sm" style="width: 300px;">
                <input type="text" name="q" value="{{ $search ?? '' }}" class="form-control" placeholder="Cari Kata" style="border-color: #8c7355; border-right: none;">
                <span class="input-group-text bg-white" style="border-color: #8c7355; border-left: none;">
                    <i class="bi bi-search" style="color: #333;"></i>
                </span>
            </div>
            <!-- Tombol Cari Cokelat -->
            <button class="btn ms-3 shadow-sm" type="submit" style="background-color: #6E491C; color: white; border-radius: 6px; padding: 6px 24px; font-weight: 500;">
                Cari
            </button>
        </form>

        <!-- Baris 2: Tombol Import CSV & Tambah Kata -->
        <div class="d-flex gap-2">
            <a href="{{ route('admin.kata.import.form') }}" class="btn btn-outline-coklat shadow-sm" style="border-radius: 6px; width: 160px; font-weight: bold;">
                <i class="bi bi-upload"></i> Import CSV
            </a>
            <button type="button" class="btn shadow-sm" data-bs-toggle="modal" data-bs-target="#tambahModal" style="background-color: #F4A259; color: white; border-radius: 6px; width: 160px; font-weight: bold;">
                Tambah Kata
            </button>
        </div>

    </div>
    
</div>
<!-- 👆👆👆 SAMPAI SINI 👆👆👆 -->

        @php
            $columns = [
                'kruna_andap' => 'Kruna Andap',
                'kruna_asi' => 'Kruna Asi',
                'kruna_aso' => 'Kruna Aso',
                'kruna_ami' => 'Kruna Ami',
                'kruna_mider' => 'Kruna Mider',
                'kruna_kasar' => 'Kruna Kasar',
                'bahasa_indonesia' => 'Bahasa Indonesia',
            ];
        @endphp

<div class="table-responsive card-kamus p-2 shadow-sm">
    <table class="table table-kamus table-striped table-hover align-middle mb-0"> 
    <table class="table-custom">
    <thead>
    <tr>
        <th>No</th>
        @foreach ($columns as $field => $label)
            @php
                $nextDirection = ($sort === $field && $direction === 'asc') ? 'desc' : 'asc';
            @endphp
            <th>
                <a style="text-decoration:none; color: black;" href="{{ route('admin.kata.index', array_filter(['q' => $search, 'sort' => $field, 'direction' => $nextDirection])) }}">
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
                        <td>{{ $katas->firstItem() + $index }}</td>
                        <!--<td>{{ $index + 1 }}</td> --->
                        <td>{{ $kata->kruna_andap }}</td>
                        <td>{{ $kata->kruna_asi }}</td>
                        <td>{{ $kata->kruna_aso }}</td>
                        <td>{{ $kata->kruna_ami }}</td>
                        <td>{{ $kata->kruna_mider }}</td>
                        <td>{{ $kata->kruna_kasar }}</td>
                        <td>{{ $kata->bahasa_indonesia }}</td>
                        <td>
                        <button type="button" class="edit-btn btn btn-outline-coklat btn-sm m-1"
                        data-id="{{ $kata->id }}"
                        data-action="{{ route('admin.kata.update', $kata->id) }}"
                        data-kruna_andap="{{ $kata->kruna_andap }}"
                        data-kruna_asi="{{ $kata->kruna_asi }}"
                        data-kruna_aso="{{ $kata->kruna_aso }}"
                        data-kruna_ami="{{ $kata->kruna_ami }}"
                        data-kruna_mider="{{ $kata->kruna_mider }}"
                        data-kruna_kasar="{{ $kata->kruna_kasar }}"
                        data-bahasa_indonesia="{{ $kata->bahasa_indonesia }}">
                        Edit
                    </button>

                        <a href="{{ route('admin.kata.relasi.index', $kata) }}" class="btn btn-outline-coklat btn-sm m-1">Relasi</a>

                           <form action="{{ route('admin.kata.destroy', $kata->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger" class="bi bi-trash3" onclick="return confirm('Are you sure?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
    </table>
    <div class="d-flex justify-content-center mt-4 mb-6">
        {{ $katas->appends(request()->query())->links() }}
    </div>
</div>

<!-- 👇👇👇 KODE MODAL TAMBAH KATA 👇👇👇 -->
<div class="modal fade modal-tambah-kata" id="tambahModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content p-2">
            
            <div class="modal-header position-relative">
                <h5 class="modal-title">Tambah Kata Baru</h5>
                <button type="button" class="btn-close position-absolute end-0 me-3" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            
            <!-- Form ini akan mengirim data ke fungsi store di controller -->
            <form action="{{ route('admin.kata.store') }}" method="POST">
                @csrf
                
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="tambah_kruna_andap" class="form-label">Kata Andap</label>
                        <input type="text" name="kruna_andap" id="tambah_kruna_andap" class="form-control" placeholder="masukan kata" required>
                    </div>
                    <div class="mb-3">
                        <label for="tambah_kruna_asi" class="form-label">Kata Alus Singgih (ASI)</label>
                        <input type="text" name="kruna_asi" id="tambah_kruna_asi" class="form-control" placeholder="masukan kata" required>
                    </div>
                    <div class="mb-3">
                        <label for="tambah_kruna_aso" class="form-label">Kata Alus Sor (ASO)</label>
                        <input type="text" name="kruna_aso" id="tambah_kruna_aso" class="form-control" placeholder="masukan kata" required>
                    </div>
                    <div class="mb-3">
                        <label for="tambah_kruna_ami" class="form-label">Kata Alus Mider (AMI)</label>
                        <input type="text" name="kruna_ami" id="tambah_kruna_ami" class="form-control" placeholder="masukan kata" required>
                    </div>
                    <div class="mb-3">
                        <label for="tambah_kruna_mider" class="form-label">Kata Mider</label>
                        <input type="text" name="kruna_mider" id="tambah_kruna_mider" class="form-control" placeholder="masukan kata" required>
                    </div>
                    <div class="mb-3">
                        <label for="tambah_kruna_kasar" class="form-label">Kasar</label>
                        <input type="text" name="kruna_kasar" id="tambah_kruna_kasar" class="form-control" placeholder="masukan kata" required>
                    </div>
                    <div class="mb-3">
                        <label for="tambah_bahasa_indonesia" class="form-label">Bahasa Indonesia</label>
                        <textarea name="bahasa_indonesia" id="tambah_bahasa_indonesia" class="form-control" rows="3" placeholder="masukan kata" required></textarea>
                    </div>
                </div>
                
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-oranye" style="background-color: #F4A259; color: white;">Simpan</button>
                </div>
            </form>
            
        </div>
    </div>
</div>
<!-- 👆👆👆 SAMPAI SINI 👆👆👆 -->

<!-- Modal Edit Baru --> 
<div class="modal fade modal-tambah-kata" id="editModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content p-2">
            
            <div class="modal-header position-relative">
                <h5 class="modal-title">Edit Kata</h5>
                <button type="button" class="btn-close position-absolute end-0 me-3" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            
            <!-- HANYA BOLEH ADA SATU TAG FORM -->
            <form method="POST" id="editForm">
                @csrf
                @method('PUT')
                
                <input type="hidden" name="kata_id" id="edit_kata_id">
                
                <div class="modal-body">
                    
                    <div class="mb-3">
                        <label for="edit_kruna_andap" class="form-label">Kata Andap</label>
                        <input type="text" name="kruna_andap" id="edit_kruna_andap" class="form-control">
                        @error('kruna_andap') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
                    </div>

                    <div class="mb-3">
                        <label for="edit_kruna_asi" class="form-label">Kata Alus Singgih (ASI)</label>
                        <input type="text" name="kruna_asi" id="edit_kruna_asi" class="form-control">
                        @error('kruna_asi') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
                    </div>

                    <div class="mb-3">
                        <label for="edit_kruna_aso" class="form-label">Kata Alus Sor (ASO)</label>
                        <input type="text" name="kruna_aso" id="edit_kruna_aso" class="form-control">
                        @error('kruna_aso') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
                    </div>

                    <div class="mb-3">
                        <label for="edit_kruna_ami" class="form-label">Kata Alus Mider (AMI)</label>
                        <input type="text" name="kruna_ami" id="edit_kruna_ami" class="form-control">
                        @error('kruna_ami') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
                    </div>

                    <div class="mb-3">
                        <label for="edit_kruna_mider" class="form-label">Kata Mider</label>
                        <input type="text" name="kruna_mider" id="edit_kruna_mider" class="form-control">
                        @error('kruna_mider') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
                    </div>

                    <div class="mb-3">
                        <label for="edit_kruna_kasar" class="form-label">Kasar</label>
                        <input type="text" name="kruna_kasar" id="edit_kruna_kasar" class="form-control">
                        @error('kruna_kasar') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
                    </div>

                    <div class="mb-3">
                        <label for="edit_bahasa_indonesia" class="form-label">Bahasa Indonesia</label>
                        <textarea name="bahasa_indonesia" id="edit_bahasa_indonesia" class="form-control" rows="4"></textarea>
                        @error('bahasa_indonesia') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
                    </div>

                </div>
                
                <div class="modal-footer">
                    <button type="button" class="btn btn-batal" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-simpan">Simpan Perubahan</button>
                </div>
                
            </form>
            
        </div>
    </div>
</div>
<!--<script>
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
    });--->

    <!-- new code untuk edit modal -->
     <script>
    document.addEventListener('DOMContentLoaded', function() {
        document.body.addEventListener('click', function(e) {
            const btn = e.target.closest('.edit-btn');
            if (btn) {
                const data = btn.dataset;
                const editForm = document.getElementById('editForm');
                
                editForm.action = data.action;
                document.getElementById('edit_kata_id').value = data.id || '';
                // ... (pengisian input lainnya)
                
                const editModalEl = document.getElementById('editModal');
                const modalInstance = bootstrap.Modal.getOrCreateInstance(editModalEl);
                modalInstance.show();
            }
        });
    });
</script>
</script>
@endsection