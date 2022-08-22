<?php

namespace App\Http\Controllers;

use App\Imports\StudentImport;
use App\Jobs\ImportExcelData;
use App\Models\Sheet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Storage;

class StudentController extends Controller
{

    public function index()
    {
        return view('welcome');
    }

    public function importExcel(Request $request)
    {
        $validatedData = $request->validate([
            'file' => 'required|file|mimes:xls,xlsx|max:500000',
        ]);
        
        $path1 = $request->file('file')->store('temp'); 
        $path = storage_path('app').'/'.$path1; 

        Sheet::create([
            'sheet_name' => htmlspecialchars($path1),
        ]);

        /* 
           We will use this command if we want to import excel using job. 
           dispatch(new ImportExcelData($path));
        */ 

        return redirect('/')->with('status', 'Import in Progress, We will notify once Import Successful.');
    }

}
