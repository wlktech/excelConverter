<?php
namespace App\Imports;

use App\Models\Database;
use App\Models\Test;
use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Support\Facades\Log;

class ImportData implements ToModel
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        try {
            $addressParts = array_map('trim', explode(',', $row[0]));

            // Check if there are enough parts in the address
            if (count($addressParts) < 4) {
                // Log error or handle as required
                Log::warning("Insufficient data in row: " . implode(', ', $row));
                return null;
            }

            return new Test([
                'road'     => $addressParts[0],
                'ward'     => $addressParts[1],
                'township' => $addressParts[2],
            ]);
        } catch (\Exception $e) {
            // Handle the exception
            Log::error("Error importing row: " . $e->getMessage());
            return null;
        }
    }
}

