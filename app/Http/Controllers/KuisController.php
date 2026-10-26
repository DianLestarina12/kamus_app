<?php

namespace App\Http\Controllers;

use App\Models\Soals;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

class KuisController extends Controller
{
    public const JUMLAH_SOAL = 10;

    // Kolom opsi pada tabel soals; jawaban benar selalu sama dengan salah satunya.
    private const KUNCI_OPSI = ['opsi1', 'opsi2', 'opsi3', 'opsi4'];

    // Pembuka: ajakan mengerjakan kuis.
    public function index()
    {
        return view('kuis.index');
    }

    // Menyusun soal acak dan menyimpan kunci jawabannya di session, bukan di halaman.
    public function mulai()
    {
        $soal = $this->buatSoal();

        if ($soal->isEmpty()) {
            return redirect()->route('kuis.index')
                ->with('error', 'Belum ada soal kuis. Tambahkan soal terlebih dahulu.');
        }

        session(['kuis' => $soal->all()]);

        return redirect()->route('kuis.soal');
    }

    public function soal()
    {
        $soal = session('kuis');

        if (! $soal) {
            return redirect()->route('kuis.index');
        }

        return view('kuis.soal', compact('soal'));
    }

    // Menilai jawaban di server lalu redirect (PRG) agar refresh tidak mengirim ulang form.
    public function selesai(Request $request)
    {
        $soal = session('kuis');

        if (! $soal) {
            return redirect()->route('kuis.index');
        }

        $jawaban = $request->input('jawaban', []);
        $jawaban = is_array($jawaban) ? $jawaban : [];

        $benar = 0;

        foreach ($soal as $nomor => $item) {
            if (($jawaban[$nomor] ?? null) === $item['benar']) {
                $benar++;
            }
        }

        $total = count($soal);

        session()->forget('kuis');

        return redirect()->route('kuis.hasil')->with('kuis_hasil', [
            'total' => $total,
            'benar' => $benar,
            'salah' => $total - $benar,
            'skor' => (int) round($benar / $total * 100),
        ]);
    }

    public function hasil()
    {
        $hasil = session('kuis_hasil');

        if (! $hasil) {
            return redirect()->route('kuis.index');
        }

        return view('kuis.hasil', compact('hasil'));
    }

    private function buatSoal(): Collection
    {
        return Soals::query()
            ->inRandomOrder()
            ->take(self::JUMLAH_SOAL)
            ->get()
            ->map(fn (Soals $soal) => $this->buatItem($soal))
            ->values();
    }

    private function buatItem(Soals $soal): array
    {
        $benar = collect(self::KUNCI_OPSI)->first(fn (string $kunci) => $soal->{$kunci} === $soal->jawaban);

        $pilihan = collect(self::KUNCI_OPSI)
            ->map(fn (string $kunci) => ['kunci' => $kunci, 'label' => $soal->{$kunci}])
            ->shuffle()
            ->values()
            ->all();

        return [
            'pertanyaan' => $soal->soal,
            'benar' => $benar,
            'pilihan' => $pilihan,
        ];
    }
}
