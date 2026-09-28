<?php
 
namespace App\Http\Controllers\Admin;
 
use App\Http\Controllers\Controller;
use App\Models\Katas;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
 
class KataRelasiController extends Controller
{
    // Kelola sinonim & homonim untuk satu kata
    public function index(Katas $kata)
    {
        $kata->load(['sinonim', 'homonim']);
 
        $pilihan = Katas::where('id', '!=', $kata->id)->orderBy('kruna_asi')->get();
 
        return view('admin.kata.relasi', compact('kata', 'pilihan'));
    }
 
    public function store(Request $request, Katas $kata)
    {
        $validated = $request->validate([
            'kata_terkait_id' => ['required', Rule::exists('katas', 'id')->whereNull('deleted_at')],
            'tipe' => ['required', Rule::in(['sinonim', 'homonim'])],
            'tingkatan' => ['nullable', Rule::in(Katas::tingkatanKeys())],
        ]);
 
        if ((int) $validated['kata_terkait_id'] === $kata->id) {
            return back()->withErrors(['kata_terkait_id' => 'Katas tidak bisa direlasikan dengan dirinya sendiri.']);
        }
 
        $sudahAda = $kata->{$validated['tipe']}()
            ->wherePivot('kata_terkait_id', $validated['kata_terkait_id'])
            ->exists();
 
        if ($sudahAda) {
            return back()->withErrors(['kata_terkait_id' => 'Relasi ini sudah terdaftar.']);
        }
 
        $kata->{$validated['tipe']}()->attach($validated['kata_terkait_id'], [
            'tipe' => $validated['tipe'],
            'tingkatan' => $validated['tingkatan'] ?? null,
        ]);
 
        return back()->with('success', 'Katas terkait berhasil ditambahkan.');
    }
 
    public function destroy(Katas $kata, string $tipe, Katas $terkait)
    {
        abort_unless(in_array($tipe, ['sinonim', 'homonim'], true), 404);
 
        $kata->{$tipe}()->detach($terkait->id);
 
        return back()->with('success', 'Katas terkait berhasil dihapus.');
    }
}
