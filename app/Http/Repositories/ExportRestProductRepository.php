<?php

namespace App\Http\Repositories;

use App\Http\Interface\ExportRestProductInterface;
use App\Http\Resources\ExportResidueResource;
use App\Jobs\ExportRestProductsJob;
use App\Models\Export;

class ExportRestProductRepository implements ExportRestProductInterface
{
    public function checkExportStatus()
    {
        $userId = auth()->user()->id;
        $export = Export::where('owner_id', $userId)->get();
        return ExportResidueResource::collection($export);
    }

    public function export($request)
    {
        $userId = auth()->user()->id;
        $validated = $request->validate([
            'start_date' => 'required|date|before_or_equal:end_date',
            'end_date' => 'required|date|after_or_equal:start_date',
        ]);

        $filePath = 'exports/' . 'qoldiq' . '.xlsx';
        // return 444;
        $export = Export::create([
            'status' => 'processing',
            'owner_id' => $userId
            
        ]);
        $data = [
            'file_path' => $filePath,
            'start_date' => $validated['start_date'],
            'end_date' => $validated['end_date'],
            'export_id' => $export->id
        ];
        ExportRestProductsJob::dispatch($data);

        return response()->json([
            'status' => 'processing',
            'message' => "Export id -> $export->id"
        ]);
    }
}
