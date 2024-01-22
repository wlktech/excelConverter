<?php

namespace App\Http\Controllers;

use App\Exports\ExportData;
use App\Imports\ImportData;
use App\Models\Test;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Facades\Excel;

class TestController extends Controller
{
    public function index()
    {
        return view('index');
    }

    public function uploadExcel(Request $request)
    {
        // Ensure the uploaded file has a correct extension
        $request->validate([
            'excel' => 'required|file|mimes:xlsx,xls,csv|max:10240', // include xls if needed
        ]);
    
        try {
            $excel = $request->file('excel');
            $temporaryPath = $excel->getRealPath();
            $fileExtension = strtolower($excel->getClientOriginalExtension());
    
            // Explicitly specifying the file type based on the extension
            $readerType = ($fileExtension === 'csv') ? \Maatwebsite\Excel\Excel::CSV : \Maatwebsite\Excel\Excel::XLSX;
    
            $import = new ImportData();
            Excel::import($import, $temporaryPath, null, $readerType);
            return redirect(route('data'))->with('success', 'Data imported successfully!');
            // Additional code for feedback...
        } catch (\Maatwebsite\Excel\Exceptions\NoTypeDetectedException $typeException) {
            // Handle file type detection exceptions
            Log::error('Excel import error: ' . $typeException->getMessage());
            return back()->with('error', 'Import failed due to an unrecognized file format. Please use a valid Excel or CSV file.');
        } catch (\Exception $e) {
            // Generic error handling...
            Log::error('Excel import error: ' . $e->getMessage());
            return back()->with('error', 'Import failed: ' . $e->getMessage());
        }
    }

    public function getData()
    {
        $data = Test::latest()->paginate(10);
        return view('data', ['data' => $data]);
    }
    
    public function export()
    {
        return Excel::download(new ExportData, 'data.xlsx');
    }
}
