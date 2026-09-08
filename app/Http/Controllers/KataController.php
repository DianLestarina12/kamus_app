<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Katas;

class KataController extends Controller
{
    public function index()
    {
        $katas = Katas::latest()->get();

        return view('kata.index', compact('katas'));
    }
    public function create()
    {
        return view('kata.create');
    }   
    public function store(Request $request)
    {
        $request->validate([
            'kruna_andap' => 'required',
            'kruna_asi' => 'required',
            'kruna_aso' => 'required',
            'kruna_ami' => 'required',
            'kruna_mider' => 'required',
            'kruna_kasar' => 'required',
            'bahasa_indonesia' => 'required',
        ]);

        Katas::create($request->all());

        return redirect()->route('kata.index')
                        ->with('success','Kata created successfully.');
                        
    }

}
