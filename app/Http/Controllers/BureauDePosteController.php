<?php

namespace App\Http\Controllers;

use App\Models\BureauDePoste;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\BureauDePostesImport;

class BureauDePosteController extends Controller
{
    public function importForm()
    {
        return view('admin.bureau-de-poste.import');
    }

    public function import(Request $request)
    {
        $request->validate([
            'csv_file' => 'required|file|mimes:csv,txt,xlsx,xls',
        ]);

        try {
            Excel::import(new BureauDePostesImport, $request->file('csv_file'));
            
            return redirect()->back()->with('success', 'Importation réussie!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Erreur lors de l\'importation: ' . $e->getMessage());
        }
    }
}