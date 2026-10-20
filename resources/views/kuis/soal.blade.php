@extends('layouts.app')

@section('title', 'Kuis Evaluasi - Kamus Anggah-Ungguh Kruna Basa Bali')

@section('content')
    <div class="kuis-kotak">
        <form method="POST" action="{{ route('kuis.selesai') }}" id="form-kuis">
            @csrf

            @foreach ($soal as $nomor => $item)
                <section class="kuis-soal {{ $nomor === 0 ? 'aktif' : '' }}" data-soal>
                    <p class="kuis-nomor">Soal {{ $nomor + 1 }} dari {{ count($soal) }}</p>

                    <h2 class="kuis-pertanyaan">
                        Kata "{{ $item['bentuk'] }}" dalam bahasa Bali termasuk dalam anggah-ungguh kruna apa?
                    </h2>

                    <div class="kuis-pilihan-daftar">
                        @foreach ($item['pilihan'] as $indeks => $pilihan)
                            <label class="kuis-pilihan">
                                <input type="radio" class="kuis-radio" name="jawaban[{{ $nomor }}]" value="{{ $pilihan['kunci'] }}">
                                <span class="kuis-huruf">{{ chr(65 + $indeks) }}</span>
                                <span>{{ $pilihan['label'] }}</span>
                            </label>
                        @endforeach
                    </div>
                </section>
            @endforeach

            <div class="kuis-navigasi">
                <button type="button" class="btn btn-selanjutnya-kuis" id="kuis-sebelumnya" hidden>Sebelumnya</button>
                <button type="button" class="btn btn-selanjutnya-kuis ms-auto" id="kuis-selanjutnya">Selanjutnya</button>
                <button type="submit" class="btn btn-selanjutnya-kuis ms-auto" id="kuis-selesai" hidden>Selesai</button>
            </div>
        </form>
    </div>
@endsection

@section('scripts')
    <script>
        (function () {
            const soal = document.querySelectorAll('[data-soal]');
            const sebelumnya = document.getElementById('kuis-sebelumnya');
            const selanjutnya = document.getElementById('kuis-selanjutnya');
            const selesai = document.getElementById('kuis-selesai');
            const form = document.getElementById('form-kuis');
            let aktif = 0;

            function tampil(indeks) {
                aktif = indeks;
                soal.forEach((el, i) => el.classList.toggle('aktif', i === aktif));
                sebelumnya.hidden = aktif === 0;
                selanjutnya.hidden = aktif === soal.length - 1;
                selesai.hidden = aktif !== soal.length - 1;
            }

            sebelumnya.addEventListener('click', () => tampil(aktif - 1));
            selanjutnya.addEventListener('click', () => tampil(aktif + 1));

            form.addEventListener('change', (event) => {
                if (!event.target.classList.contains('kuis-radio')) return;
                event.target.closest('.kuis-pilihan-daftar')
                    .querySelectorAll('.kuis-pilihan')
                    .forEach((label) => label.classList.toggle('dipilih', label.querySelector('input').checked));
            });

            form.addEventListener('submit', (event) => {
                const belumDijawab = [...soal].filter((el) => !el.querySelector('input:checked')).length;
                if (belumDijawab > 0 && !confirm(`Masih ada ${belumDijawab} soal yang belum dijawab. Tetap selesai?`)) {
                    event.preventDefault();
                }
            });

            tampil(0);
        })();
    </script>
@endsection
