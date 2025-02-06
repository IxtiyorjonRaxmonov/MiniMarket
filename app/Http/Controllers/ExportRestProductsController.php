<?php

namespace App\Http\Controllers;

use App\Exports\RestProductExport;
use App\Http\Interface\ExportRestProductInterface;
use App\Http\Resources\ExportResidueResource;
use App\Jobs\ExportRestProductsJob;
use App\Models\Export;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ExportRestProductsController extends Controller
{
    public function __construct(private ExportRestProductInterface $exportRestProductInterface)
    {
        
    }
    public function checkExportStatus()
    {
        return $this->exportRestProductInterface->checkExportStatus();
    }

    public function export(Request $request)
    {
        return $this->exportRestProductInterface->export($request);
    }
}
