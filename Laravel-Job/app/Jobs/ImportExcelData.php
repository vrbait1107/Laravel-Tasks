<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Imports\StudentImport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Storage;
use App\Models\Student;
use Illuminate\Http\Testing\File;

class ImportExcelData implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */

    public $file;


    public function __construct($file)
    {
        $this->file = str_replace( "\\", "/", $file);
        //$this->file =$file;   
    }

    /**
     * Execute the job.
     *
     * @return void
     */

    
    public function handle()
    {
        //Excel::import(new StudentImport, $this->file, null, \Maatwebsite\Excel\Excel::XLSX);
        Excel::import(new StudentImport, $this->file);
    }

}
