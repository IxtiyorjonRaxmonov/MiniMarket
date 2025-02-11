<?php

namespace App\Jobs;

use App\Events\ExportCompleted;
use App\Exports\RestProductExport;
use App\Models\Export;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\Job;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Facades\Excel;

class ExportRestProductsJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */

    public function __construct(private $data) {}
    public function handle()
    {
        try {
            $filePath = $this->data['file_path'];
            $startDate = $this->data['start_date'];
            $endDate = $this->data['end_date'];
            $exportId = $this->data['export_id'];

            Excel::store(new RestProductExport($startDate, $endDate), $filePath, 'public');

            Export::where('id', $exportId)->update([
                'status' => 'completed',
                'file_path' => $filePath
            ]);
        } catch (\Exception $e) {
            $token = env('BOT_NOTIFICATION_TOKEN');
            Http::post("https://api.telegram.org/bot$token/sendMessage", [
                'chat_id' => env('BOT_ADMIN_CHAT_ID'),
                'text' => json_encode([
                    'message' => $e->getMessage(),
                    'auth' => auth()->user(),
                    'status_code' => $e->getCode()
                ], JSON_PRETTY_PRINT)
            ]);
            Export::where('id', $exportId)->update(['status' => 'failed']);
        }
    }
}
