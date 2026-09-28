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
 
        $tingkatanKeys = Katas::tingkatanKeys();
 
        $katas = Katas::query()
            ->where(function ($query) use ($tingkatanKeys, $search) {
                foreach ($tingkatanKeys as $kolom) {
                    $query->orWhere($kolom, 'like', '%' . $search . '%');
                }
            })
            ->get();
 
        $hasil = [];
        $terlihat = [];
 
        foreach ($katas as $kata) {
            foreach ($tingkatanKeys as $kolom) {
                $bentuk = $kata->{$kolom};
 
                if (blank($bentuk) || ! str_contains(mb_strtolower($bentuk), mb_strtolower($search))) {
                    continue;
                }
 
                // Satu kata bisa punya bentuk identik di beberapa tingkatan; tampilkan sekali saja.
                $kunci = $kata->id . '|' . mb_strtolower($bentuk);
 
                if (isset($terlihat[$kunci])) {
                    continue;
                }
 
                $terlihat[$kunci] = true;
                $hasil[] = ['kata' => $kata, 'bentuk' => $bentuk, 'tingkatan' => $kolom];
            }
        }
 
        $grup = collect($hasil)
            ->sortBy(fn ($item) => mb_strtolower($item['bentuk']), SORT_NATURAL)
            ->groupBy(fn ($item) => mb_strtoupper(mb_substr($item['bentuk'], 0, 1)))
            ->sortKeys();
 
        return view('kamus.hasil', compact('grup', 'search'));
    }
 
    // Detail katas: tabel anggah-ungguh lengkap + kata terkait
    public function show(Request $request, Katas $kata)
    {
        $kata->load(['sinonim', 'homonim']);
 
        $tingkatan = $request->query('tingkatan');
 
        if (! in_array($tingkatan, Katas::tingkatanKeys(), true)) {
            $tingkatan = null;
        }
 
        $berikutnya = Katas::where('id', '>', $kata->id)->orderBy('id')->first();
 
        return view('kamus.detail', compact('kata', 'tingkatan', 'berikutnya'));
    }
}
