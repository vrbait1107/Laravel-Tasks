<?php

namespace App\Http\Controllers;

use App\Imports\StudentImport;
use App\Jobs\ImportExcelData;
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

        dispatch(new ImportExcelData($path));

        return redirect('/')->with('status', 'The file Has Been Imported to Database in Laravel 9');
    }

}
