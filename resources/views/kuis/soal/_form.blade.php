<div class="mb-3">
    <label for="soal" class="form-label">Soal</label>
    <input type="text" name="soal" id="soal" class="form-control @error('soal') is-invalid @enderror" placeholder="Masukkan Soal" value="{{ old('soal', $soal->soal ?? '') }}">
    @error('soal')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

@foreach ([1, 2, 3, 4] as $nomor)
    <div class="mb-3">
        <label for="opsi{{ $nomor }}" class="form-label">Opsi {{ $nomor }}</label>
        <input type="text" name="opsi{{ $nomor }}" id="opsi{{ $nomor }}" class="form-control @error('opsi' . $nomor) is-invalid @enderror" placeholder="Masukkan Opsi" value="{{ old('opsi' . $nomor, $soal->{'opsi' . $nomor} ?? '') }}">
        @error('opsi' . $nomor)
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
@endforeach

<div class="mb-3">
    <label for="jawaban" class="form-label">Jawaban Benar</label>
    <input type="text" name="jawaban" id="jawaban" class="form-control @error('jawaban') is-invalid @enderror" placeholder="Harus sama dengan salah satu opsi" value="{{ old('jawaban', $soal->jawaban ?? '') }}">
    @error('jawaban')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>
