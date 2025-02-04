<?php

namespace App\Http\Controllers;

use App\Exports\RestProductExport;
use App\Jobs\ExportRestProductsJob;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ExportRestProductsController extends Controller
{


    public function export(Request $request)
    {
       $validated = $request->validate([
            'start_date' => 'required|date|before_or_equal:end_date',
            'end_date' => 'required|date|after_or_equal:start_date',
        ]);


        $filePath = 'exports/' . uniqid() . '.xlsx';
        dispatch(new ExportRestProductsJob($filePath, $validated['start_date'], $validated['end_date']));

        // Excel::download(new RestProductExport, $filePath);

        return response()->json([
            'message' => 'Export is being processed in the background.',
            'file_url' => url("storage/$filePath")

        ]);
    }
}
