<?php

namespace App\Http\Controllers;

use App\Imports\ImportData;
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
        $request->validate(['excel' => 'required|mimes:xls,xlsx|max:2048']); // Example with size limit
    
        try {
            $excel = $request->file('excel');
            $temporaryPath = $excel->getRealPath();
    
            // Import using the temporary path
            Excel::import(new ImportData, $temporaryPath);
    
            // Provide more detailed feedback
            // e.g., count of imported records (this requires modification in ImportData)
            return redirect()->route('data')->with('success', 'Addresses imported successfully.');
    
        } catch (\Exception $e) {
            // User-friendly error message
            Log::error('Excel import error: ' . $e->getMessage());
            return back()->with('error', 'Import failed due to a server error. Please try again later.');
        }
    }
    

    public function getData()
    {
        $data = Database::latest()->paginate(10);
        return view('data', ['data' => $data]);
    }
    
    public function export()
    {
        return Excel::download(new ExportData, 'data.xlsx');
    }
}
