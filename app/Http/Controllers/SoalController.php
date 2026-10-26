<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Soals;

class SoalController extends Controller
{
    public function index()
    {
        $soals = Soals::latest()->get();
        return view('kuis.soal.index', compact('soals'));
    }
    public function create()
    {
        return view('kuis.soal.create');
    }
    public function store(Request $request)
    {
        Soals::create($this->validasi($request));

        return redirect()->route('soal.index')
                        ->with('success','Soal created successfully.');
                        
    }

    public function edit($id)
    {
        $soal = Soals::findOrFail($id);
        return view('kuis.soal.edit', compact('soal'));
    }

    public function update(Request $request, $id)
    {
        $soal = Soals::findOrFail($id);
        $soal->update($this->validasi($request));

        return redirect()->route('soal.index')
                        ->with('success','Soal updated successfully.');
    }

    public function destroy($id)
    {
        $soal = Soals::findOrFail($id);
        $soal->delete();

        return redirect()->route('soal.index')
                        ->with('success','Soal deleted successfully.');
    }

    // Jawaban harus salah satu dari keempat opsi, supaya kunci jawaban selalu ada di pilihan.
    private function validasi(Request $request): array
    {
        return $request->validate([
            'soal' => 'required|string',
            'opsi1' => 'required|string',
            'opsi2' => 'required|string',
            'opsi3' => 'required|string',
            'opsi4' => 'required|string',
            'jawaban' => [
                'required',
                'string',
                function (string $attribute, mixed $value, \Closure $fail) use ($request) {
                    $opsi = [$request->input('opsi1'), $request->input('opsi2'), $request->input('opsi3'), $request->input('opsi4')];

                    if (! in_array($value, $opsi, true)) {
                        $fail('Jawaban harus sama dengan salah satu opsi.');
                    }
                },
            ],
        ]);
    }
}
