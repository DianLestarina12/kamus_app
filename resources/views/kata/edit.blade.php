@extends('template')

@section('modal')
<!-- Modal -->
<div class="" >
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Kata</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
         <form method="POST" action="{{ route('kata.update', $kata) }}">
        @csrf
        @method('PUT')

        <label for="kruna_andap">Kata Andap</label>
        <input type="text" name="kruna_andap" id="kruna_andap" value="{{ old('kruna_andap', $kata->kruna_andap) }}">
        @error('kruna_andap')
            <div class="error">{{ $message }}</div>
        @enderror

        <label for="kruna_andap">Kata Asi</label>
        <input type="text" name="kruna_asi" id="kruna_asi" value="{{ old('kruna_asi', $kata->kruna_asi) }}">
        @error('kruna_asi')
            <div class="error">{{ $message }}</div>
        @enderror

        <label for="kruna_andap">Kata Aso</label>
        <input type="text" name="kruna_aso" id="kruna_aso" value="{{ old('kruna_aso', $kata->kruna_aso) }}">
        @error('kruna_aso')
            <div class="error">{{ $message }}</div>
        @enderror

        <label for="kruna_andap">Kata Ami</label>
        <input type="text" name="kruna_ami" id="kruna_ami" value="{{ old('kruna_ami', $kata->kruna_ami) }}">
        @error('kruna_ami')
            <div class="error">{{ $message }}</div>
        @enderror

        <label for="kruna_andap">Kata Mider</label>
        <input type="text" name="kruna_mider" id="kruna_mider" value="{{ old('kruna_mider', $kata->kruna_mider) }}">
        @error('kruna_mider')
            <div class="error">{{ $message }}</div>
        @enderror

        <label for="kruna_andap">Kata Kasar</label>
        <input type="text" name="kruna_kasar" id="kruna_kasar" value="{{ old('kruna_kasar', $kata->kruna_kasar) }}">
        @error('kruna_kasar')
            <div class="error">{{ $message }}</div>
        @enderror

        <label for="kruna_andap">Bahasa Indonesia</label>
        <input type="text" name="bahasa_indonesia" id="bahasa_indonesia" value="{{ old('bahasa_indonesia', $kata->bahasa_indonesia) }}">
        @error('bahasa_indonesia')
            <div class="error">{{ $message }}</div>
        @enderror

        <button type="submit">Simpan Perubahan</button>
        <a href="{{ route('kata.index') }}">Kembali</a>
    </form> 
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>
<!-- End Modal -->

    <!-- <h1>Edit Kata</h1> -->

    <!-- <form method="POST" action="{{ route('kata.update', $kata) }}">
        @csrf
        @method('PUT')

        <label for="kruna_andap">Kata Andap</label>
        <input type="text" name="kruna_andap" id="kruna_andap" value="{{ old('kruna_andap', $kata->kruna_andap) }}">
        @error('kruna_andap')
            <div class="error">{{ $message }}</div>
        @enderror

        <label for="kruna_andap">Kata Asi</label>
        <input type="text" name="kruna_asi" id="kruna_asi" value="{{ old('kruna_asi', $kata->kruna_asi) }}">
        @error('kruna_asi')
            <div class="error">{{ $message }}</div>
        @enderror

        <label for="kruna_andap">Kata Aso</label>
        <input type="text" name="kruna_aso" id="kruna_aso" value="{{ old('kruna_aso', $kata->kruna_aso) }}">
        @error('kruna_aso')
            <div class="error">{{ $message }}</div>
        @enderror

        <label for="kruna_andap">Kata Ami</label>
        <input type="text" name="kruna_ami" id="kruna_ami" value="{{ old('kruna_ami', $kata->kruna_ami) }}">
        @error('kruna_ami')
            <div class="error">{{ $message }}</div>
        @enderror

        <label for="kruna_andap">Kata Mider</label>
        <input type="text" name="kruna_mider" id="kruna_mider" value="{{ old('kruna_mider', $kata->kruna_mider) }}">
        @error('kruna_mider')
            <div class="error">{{ $message }}</div>
        @enderror

        <label for="kruna_andap">Kata Kasar</label>
        <input type="text" name="kruna_kasar" id="kruna_kasar" value="{{ old('kruna_kasar', $kata->kruna_kasar) }}">
        @error('kruna_kasar')
            <div class="error">{{ $message }}</div>
        @enderror

        <label for="kruna_andap">Bahasa Indonesia</label>
        <input type="text" name="bahasa_indonesia" id="bahasa_indonesia" value="{{ old('bahasa_indonesia', $kata->bahasa_indonesia) }}">
        @error('bahasa_indonesia')
            <div class="error">{{ $message }}</div>
        @enderror

        <button type="submit">Simpan Perubahan</button>
        <a href="{{ route('kata.index') }}">Kembali</a>
    </form>  -->
@endsection