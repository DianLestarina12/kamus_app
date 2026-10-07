<?php
 
namespace App\Http\Controllers\Admin;
 
use App\Http\Controllers\Controller;
use App\Models\Katas;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
 
class KataRelasiController extends Controller
{
    // Kelola homonim untuk satu kata. Sinonim tidak dikelola di sini karena dihitung otomatis dari arti
    // bahasa Indonesia (lihat Katas::sinonimSearti()).
    public function index(Katas $kata)
    {
        $kata->load('homonim');
 
        $pilihan = Katas::where('id', '!=', $kata->id)->orderBy('kruna_asi')->get();
 
        return view('admin.kata.relasi', compact('kata', 'pilihan'));
    }
 
    public function store(Request $request, Katas $kata)
    {
        $validated = $request->validate([
            'kata_terkait_id' => ['required', Rule::exists('katas', 'id')->whereNull('deleted_at')],
            'tingkatan' => ['nullable', Rule::in(Katas::tingkatanKeys())],
        ]);
 
        if ((int) $validated['kata_terkait_id'] === $kata->id) {
            return back()->withErrors(['kata_terkait_id' => 'Kata tidak bisa direlasikan dengan dirinya sendiri.']);
        }
 
        $sudahAda = $kata->homonim()
            ->wherePivot('kata_terkait_id', $validated['kata_terkait_id'])
            ->exists();
 
        if ($sudahAda) {
            return back()->withErrors(['kata_terkait_id' => 'Relasi ini sudah terdaftar.']);
        }
 
        $kata->homonim()->attach($validated['kata_terkait_id'], [
            'tipe' => 'homonim',
            'tingkatan' => $validated['tingkatan'] ?? null,
        ]);
 
        return back()->with('success', 'Kata terkait berhasil ditambahkan.');
    }
 
    public function destroy(Katas $kata, string $tipe, Katas $terkait)
    {
        abort_unless($tipe === 'homonim', 404);
 
        $kata->homonim()->detach($terkait->id);
 
        return back()->with('success', 'Kata terkait berhasil dihapus.');
    }
}
