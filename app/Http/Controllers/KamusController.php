<?php
 
namespace App\Http\Controllers;
 
use App\Models\Katas;
use Illuminate\Http\Request;
 
class KamusController extends Controller
{
    // Beranda: hero + kolom pencarian
    public function beranda()
    {
        return view('kamus.beranda');
    }
 
    // Hasil pencarian: setiap bentuk kata yang cocok tampil sebagai baris tersendiri,
    // dikelompokkan menurut huruf awal.
    public function cari(Request $request)
    {
        $search = trim((string) $request->query('q', ''));
 
        if ($search === '') {
            return redirect()->route('kamus.beranda');
        }
 
        $grup = $this->hasilPencarian($search);
 
        return view('kamus.hasil', compact('grup', 'search'));
    }
 
    // Detail katas: tabel anggah-ungguh lengkap + kata terkait
    public function show(Request $request, Katas $kata)
    {
        $sinonim = $kata->sinonimSearti();
 
        $tingkatan = $request->query('tingkatan');
 
        if (! in_array($tingkatan, Katas::tingkatanKeys(), true)) {
            $tingkatan = null;
        }
 
        $homonim = $kata->homonimSebentuk($tingkatan);
 
        $berikutnya = $this->berikutnya($kata, $tingkatan, trim((string) $request->query('q', '')));
 
        return view('kamus.detail', compact('kata', 'sinonim', 'homonim', 'tingkatan', 'berikutnya'));
    }
 
    // Tautan "Selanjutnya": entri berikutnya pada hasil pencarian /cari?q=...,
    // atau kata dengan id berikutnya bila halaman tidak dibuka dari pencarian.
    protected function berikutnya(Katas $kata, ?string $tingkatan, string $search): ?string
    {
        if ($search !== '') {
            $hasil = $this->hasilPencarian($search)->flatten(1)->values();
 
            $posisi = $hasil->search(fn ($item) => $item['kata']->id === $kata->id
                && ($tingkatan === null || $item['tingkatan'] === $tingkatan));
 
            if ($posisi !== false) {
                $item = $hasil->get($posisi + 1);
 
                return $item
                    ? route('kamus.detail', ['kata' => $item['kata'], 'tingkatan' => $item['tingkatan'], 'q' => $search])
                    : null;
            }
        }
 
        $berikutnya = Katas::where('id', '>', $kata->id)->orderBy('id')->first();
 
        return $berikutnya ? route('kamus.detail', $berikutnya) : null;
    }
 
    // Setiap bentuk kata yang cocok sebagai satu entri, dikelompokkan menurut huruf awal.
    // Kata dicari di bentuk Bali (cocok sebagian) dan di arti bahasa Indonesia (makna yang sama persis).
    protected function hasilPencarian(string $search)
    {
        $tingkatanKeys = Katas::tingkatanKeys();
        $artiDicari = Katas::daftarArti($search);
 
        $katas = Katas::query()
            ->where(function ($query) use ($tingkatanKeys, $search) {
                foreach ($tingkatanKeys as $kolom) {
                    $query->orWhere($kolom, 'like', '%' . $search . '%');
                }
 
                $query->orWhere('bahasa_indonesia', 'like', '%' . $search . '%');
            })
            ->get();
 
        $hasil = [];
        $terlihat = [];
 
        $tambah = function (Katas $kata, string $bentuk, string $kolom, bool $cocokArti) use (&$hasil, &$terlihat) {
            // Satu kata bisa punya bentuk identik di beberapa tingkatan; tampilkan sekali saja.
            $kunci = $kata->id . '|' . mb_strtolower($bentuk);
 
            if (isset($terlihat[$kunci])) {
                return;
            }
 
            $terlihat[$kunci] = true;
            $hasil[] = ['kata' => $kata, 'bentuk' => $bentuk, 'tingkatan' => $kolom, 'cocok_arti' => $cocokArti];
        };
 
        foreach ($katas as $kata) {
            foreach ($tingkatanKeys as $kolom) {
                $bentuk = $kata->{$kolom};
 
                if (Katas::adaBentuk($bentuk) && str_contains(mb_strtolower($bentuk), mb_strtolower($search))) {
                    $tambah($kata, $bentuk, $kolom, false);
                }
            }
 
            $utama = $kata->tingkatanUtama();
 
            if ($utama && array_intersect($artiDicari, Katas::daftarArti($kata->bahasa_indonesia)) !== []) {
                $tambah($kata, $kata->{$utama}, $utama, true);
            }
        }
 
        return collect($hasil)
            ->sortBy(fn ($item) => mb_strtolower($item['bentuk']), SORT_NATURAL)
            ->groupBy(fn ($item) => mb_strtoupper(mb_substr($item['bentuk'], 0, 1)))
            ->sortKeys();
    }
}
