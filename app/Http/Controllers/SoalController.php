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
    {$request->validate([
            'soal' => 'required',
            'jawaban' => 'required',
            'opsi1' => 'required',
            'opsi2' => 'required',
            'opsi3' => 'required',
            'opsi4' => 'required',
        ]);

        Soals::create($request->all());

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
        $request->validate([
            'soal' => 'required',
            'jawaban' => 'required',
            'opsi1' => 'required',
            'opsi2' => 'required',
            'opsi3' => 'required',
            'opsi4' => 'required',
        ]);

        $soal = Soals::findOrFail($id);
        $soal->update($request->all());

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
}
