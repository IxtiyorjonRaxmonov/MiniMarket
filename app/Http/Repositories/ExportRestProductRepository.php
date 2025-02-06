<?php

namespace App\Http\Repositories;

use App\Http\Interface\ExportRestProductInterface;
use App\Http\Resources\ExportResidueResource;
use App\Jobs\ExportRestProductsJob;
use App\Models\Export;

class ExportRestProductRepository implements ExportRestProductInterface{
    public function checkExportStatus()
    {
        $export = Export::where('owner_id', auth()->id())->get();
        return ExportResidueResource::collection($export);

    }

    public function export($request)
    {
        $validated = $request->validate([
            'start_date' => 'required|date|before_or_equal:end_date',
            'end_date' => 'required|date|after_or_equal:start_date',
        ]);

        $filePath = 'exports/' . 'qoldiq' . '.xlsx';
        // return 444;
        $export = Export::create(['status' => 'processing']);
        $data = [
            'file_path' => $filePath,
            'start_date' => $validated['start_date'],
            'end_date' => $validated['end_date'],
            'export_id' => $export->id
        ];
        ExportRestProductsJob::dispatch($data);

        return response()->json([
            'status' => 'processing',
            'message' => 'Export is still being processed. Please try again later.'
        ]);

    }

}
    