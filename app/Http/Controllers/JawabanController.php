<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Jawabans;

class JawabanController extends Controller
{
    public function index()
    {
        $jawabans = Jawabans::latest()->get();

        return view('jawaban.index', compact('jawabans'));
    }
    public function create()
    {
        return view('jawaban.create');
    }   
    public function store(Request $request)
    {
        $request->validate([
            'id_soal' => 'required',
            'jawaban' => 'required',
            'true_false' => 'required',
        ]);

        Jawabans::create($request->all());

        return redirect()->route('jawaban.index')
                        ->with('success','Jawaban created successfully.');
                        
    }

}
