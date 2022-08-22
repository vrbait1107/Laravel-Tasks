<?php

namespace App\Console\Commands;

use App\Imports\StudentImport;
use App\Models\Sheet;
use App\Models\Student;
use Illuminate\Console\Command;
use Maatwebsite\Excel\Facades\Excel;

class MakeExcel extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'excel:run';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {

        $files = Sheet::select('sheet_name')->where('is_imported', 0)->get();

        if (count($files) <= 0) {
            $this->output->warning('No Files Available for Import Thanks.');
            exit;
        }

        $this->output->title('Starting import');

        # To Avoid N+1 Query We are Merging Array then Insert.
        $insertArray = [];

        foreach ($files as $file) {
            $insert_data = Excel::toArray(new StudentImport, str_replace("\\", "/", storage_path('app') . '/' . $file->sheet_name));

            $insertArray =  array_merge($insertArray, $insert_data[0]);
           
            Sheet::where('sheet_name', $file->sheet_name)->update(['is_imported' => 1]);

            if (file_exists(str_replace("\\", "/", storage_path('app') . '/' . $file->sheet_name))) {
                unlink(str_replace("\\", "/", storage_path('app') . '/' . $file->sheet_name));
            }
        }

        Student::insert($insertArray);
        $this->output->success('Import successful');
    }
}
