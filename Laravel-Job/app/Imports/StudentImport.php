<?php

namespace App\Imports;

use App\Models\Student;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use App\Jobs\ImportExcelData;
use Maatwebsite\Excel\Facades\Excel;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Illuminate\Contracts\Queue\ShouldQueue;


class StudentImport implements ToModel, WithHeadingRow
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        return new Student([
            'roll_no'     => $row['roll_no'],
            'first_name'     => $row['first_name'],
            'last_name'     => $row['last_name'],
            'gender'     => $row['gender'],
            'country'     => $row['country'],
            'age'     => $row['age'],
        ]);
    }

   
}
