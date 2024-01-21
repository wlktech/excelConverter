<?php

namespace App\Exports;

use App\Models\Database;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ExportData implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Database::select('homeNo', 'road', 'ward', 'township')->get();
    }

    public function headings(): array
    {
        // Define column headings
        return [
            'အိမ်အမှတ်',
            'လမ်း',
            'ရပ်ကွက်',
            'မြို့',
            // Add more column names as needed
        ];
    }
}
