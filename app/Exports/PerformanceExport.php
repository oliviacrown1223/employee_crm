<?php

namespace App\Exports;
use App\Models\SuperAdmin\Performance;
use Maatwebsite\Excel\Concerns\FromCollection;
class PerformanceExport implements FromCollection
{
    public function collection()
    {
        return Performance::all();
    }
}

