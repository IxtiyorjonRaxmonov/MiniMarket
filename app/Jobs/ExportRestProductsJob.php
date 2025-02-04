<?php

namespace App\Jobs;

use App\Events\ExportCompleted;
use App\Exports\RestProductExport;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Facades\Excel;

class ExportRestProductsJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    protected $filePath;
    protected $startDate;
    protected $endDate;

    public function __construct($filePath,$startDate, $endDate)
    {
        $this->filePath = $filePath;
        $this->startDate = $startDate;
        $this->endDate = $endDate;
    }

    public function handle()
    {
        Log::info('Export job started.');
        
        Excel::store(new RestProductExport($this->startDate, $this->endDate), $this->filePath, 'public');

        Log::info('Export completed! Dispatching event.');

        event(new ExportCompleted($this->filePath));

        Log::info('ExportCompleted event dispatched.');
    }
}





