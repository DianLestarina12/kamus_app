<?php

namespace App\Http\Controllers;

use App\Models\Katas;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

class KuisController extends Controller
{
    public const JUMLAH_SOAL = 10;
    public const JUMLAH_PILIHAN = 4;

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
                ->with('error', 'Belum ada kata yang bisa dijadikan soal kuis.');
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
        return Katas::query()
            ->get()
            ->map(fn (Katas $kata) => ['kata' => $kata, 'kolom' => $this->tingkatanTunggal($kata)])
            ->filter(fn (array $item) => $item['kolom'] !== null)
            ->shuffle()
            ->unique(fn (array $item) => $item['kata']->{$item['kolom']})
            ->take(self::JUMLAH_SOAL)
            ->map(fn (array $item) => $this->buatItem($item['kata'], $item['kolom']))
            ->values();
    }

    // Hanya kata yang punya tepat satu tingkatan yang dipakai, supaya jawabannya tidak ambigu.
    private function tingkatanTunggal(Katas $kata): ?string
    {
        $terisi = array_values(array_filter(
            Katas::tingkatanKeys(),
            fn (string $kolom) => Katas::adaBentuk($kata->{$kolom})
        ));

        return count($terisi) === 1 ? $terisi[0] : null;
    }

    private function buatItem(Katas $kata, string $kolom): array
    {
        $pengecoh = collect(Katas::tingkatanKeys())
            ->reject(fn (string $key) => $key === $kolom)
            ->shuffle()
            ->take(self::JUMLAH_PILIHAN - 1);

        $pilihan = $pengecoh
            ->push($kolom)
            ->shuffle()
            ->map(fn (string $key) => ['kunci' => $key, 'label' => Katas::tingkatanLabel($key)])
            ->values()
            ->all();

        return [
            'bentuk' => $kata->{$kolom},
            'benar' => $kolom,
            'pilihan' => $pilihan,
        ];
    }
}
