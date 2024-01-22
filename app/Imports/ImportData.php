<?php
namespace App\Imports;

use App\Models\Database;
use App\Models\Test;
use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ImportData implements ToModel, WithHeadingRow
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        try {
            $addressParts = array_map('trim', explode(',', $row['full_address']));
            if (count($addressParts) < 4) {
                Log::warning("Insufficient data in row: " . implode(', ', $row));
                return null;
            }
            return new Database([
                'homeNo'     => $addressParts[0],
                'road'     => $addressParts[1],
                'ward' => $addressParts[2],
                'township' => $addressParts[3],
            ]);
        } catch (\Exception $e) {
            Log::error("Error importing row: " . $e->getMessage());
            return null;
        }
    }
}

