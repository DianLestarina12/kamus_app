<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Soals;

class SoalController extends Controller
{
    public function index()
    {
        $soals = Soals::latest()->get();
        return view('soal.index', compact('soals'));
    }
    public function create()
    {
        return view('soal.create');
    }
    public function store(Request $request)
    {$request->validate([
            'soal' => 'required',
            'jawaban' => 'required',
        ]);

        Soals::create($request->all());

        return redirect()->route('soal.index')
                        ->with('success','Soal created successfully.');
                        
    }
}
