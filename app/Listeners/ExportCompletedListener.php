<?php

namespace App\Listeners;

use App\Events\ExportCompleted;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;

class ExportCompletedListener implements ShouldQueue
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(ExportCompleted $event)
    {
        Log::info('✅ ExportCompletedListener triggered! File path: ' . $event->filePath);

        
        // Generate a public URL (if stored in 'storage/app/public')
        $fileUrl = asset('storage/' . $event->filePath);

        // Log the file URL
        Log::info('📂 Export file available at: ' . $fileUrl);

    }
}
