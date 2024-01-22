<?php

namespace App\Http\Controllers;

use App\Exports\ExportData;
use App\Imports\ImportData;
use App\Models\Database;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Facades\Excel;

class DataController extends Controller
{
    public function index()
    {
        $data = Database::latest()->get();
        return view('index', compact('data'));
    }

    public function uploadExcel(Request $request)
    {
        $request->validate(['excel' => 'required|mimes:xls,xlsx|max:2048']); // Example with size limit

        Excel::import(new ImportData, $request->file('excel'));
        return back()->with('success', 'Data imported successfully.');
    }
    
    public function export()
    {
        return Excel::download(new ExportData, 'data.xlsx');
    }

    public function bulkDelete()
    {
        $datas = Database::all();
        foreach ($datas as $data) {
            $data->delete();
        }
        return redirect()->back()->with('success', 'All data deleted successfully.');
    }
}


