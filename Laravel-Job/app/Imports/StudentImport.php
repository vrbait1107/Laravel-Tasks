<?php

namespace App\Imports;

use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class StudentImport implements ToCollection, WithHeadingRow 
{
    public function collection(Collection $collection)
    {
        return $collection;
    }

}
