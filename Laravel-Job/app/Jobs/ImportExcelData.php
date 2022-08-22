<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Imports\StudentImport;
use Maatwebsite\Excel\Facades\Excel;


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
    }

    /**
     * Execute the job.
     *
     * @return void
     */

    
    public function handle()
    {
        Excel::import(new StudentImport, $this->file);
    }

}
