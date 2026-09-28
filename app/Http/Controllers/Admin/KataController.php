<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Katas;
use Illuminate\Support\Facades\DB;

class KataController extends Controller
{
    protected const SORTABLE_COLUMNS = [
        'kruna_andap', 'kruna_asi', 'kruna_aso', 'kruna_ami', 'kruna_mider', 'kruna_kasar', 'bahasa_indonesia',
    ];

    public function index(Request $request)
    {
        $search = trim((string) $request->query('q', ''));
        $sort = in_array($request->query('sort'), self::SORTABLE_COLUMNS, true)
            ? $request->query('sort')
            : null;
        $direction = $request->query('direction') === 'desc' ? 'desc' : 'asc';

        $query = Katas::query();

        if ($search !== '') {
            $query->where(function ($q) use ($search) {
                foreach (self::SORTABLE_COLUMNS as $column) {
                    $q->orWhere($column, 'like', '%' . $search . '%');
                }
            });
        }

        $sort ? $query->orderBy($sort, $direction) : $query->latest();

        $katas = $query->paginate(10);

        return view('kata.index', compact('katas', 'search', 'sort', 'direction'));
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

    public function edit($id)
    {
        $kata = Katas::findOrFail($id);
        return view('kata.edit', compact('kata'));
    }

    public function update(Request $request, $id)
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

        $kata = Katas::findOrFail($id);
        $kata->update($request->all());

        return redirect()->route('kata.index')
                        ->with('success','Kata updated successfully');
    } 

    public function destroy($id)
    {
        $kata = Katas::findOrFail($id);
        $kata->delete();

        return redirect()->route('kata.index')
                        ->with('success','Kata deleted successfully');
    }

    public function importForm()
    {
        return view('kata.import');
    }


    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|file|mimes:csv,txt',
        ]);

        $handle = fopen($request->file('file')->getRealPath(), 'r');
        fgetcsv($handle); // skip header row

        $imported = 0;
        $skipped = 0;
        $rowsToInsert = [];
        $chunkSize = 1000; // Process 1,000 rows per batch

        while (($row = fgetcsv($handle)) !== false) {
            $kruna_andap = trim($row[0] ?? '');
            $bahasa_indonesia = trim($row[6] ?? '');

            // Count as skipped if critical fields are empty
            if ($kruna_andap === '' || $bahasa_indonesia === '') {
                $skipped++;
                continue;
            }

            $kruna_andap = trim($row[0] ?? '');
            $kruna_asi = trim($row[1] ?? '');
            $kruna_aso = trim($row[2] ?? '');
            $kruna_ami = trim($row[3] ?? '');
            $kruna_mider = trim($row[4] ?? '');
            $kruna_kasar = trim($row[5] ?? '');
            $bahasa_indonesia = trim($row[6] ?? '');

            $rowsToInsert[] = [
                'kruna_andap' => $kruna_andap !== '' ? $kruna_andap : null,
                'kruna_asi' => $kruna_asi !== '' ? $kruna_asi : null, 
                'kruna_aso' => $kruna_aso !== '' ? $kruna_aso : null,
                'kruna_ami' => $kruna_ami !== '' ? $kruna_ami : null,
                'kruna_mider' => $kruna_mider !== '' ? $kruna_mider : null,
                'kruna_kasar' => $kruna_kasar !== '' ? $kruna_kasar : null,
                'bahasa_indonesia' => $bahasa_indonesia,
            ];

            // Process in chunks to keep memory usage low
            if (count($rowsToInsert) >= $chunkSize) {
                // insertOrIgnore skips duplicates natively at the database level
                $insertedInBatch = Katas::insertOrIgnore($rowsToInsert);
                
                $imported += $insertedInBatch;
                $skipped += (count($rowsToInsert) - $insertedInBatch);
                
                $rowsToInsert = []; // Reset batch array
            }
        }

        // Process any remaining rows left in the array
        if (count($rowsToInsert) > 0) {
            $insertedInBatch = Katas::insertOrIgnore($rowsToInsert);
            $imported += $insertedInBatch;
            $skipped += (count($rowsToInsert) - $insertedInBatch);
        }

        fclose($handle);

        return redirect()->route('kata.index')
            ->with('success', "Import selesai: {$imported} kata ditambahkan, {$skipped} dilewati (duplikat/kosong).");
    }
    
}
