<?php

namespace App\Events;

use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class ExportCompleted
{
    use Dispatchable, SerializesModels;

    public $filePath;

    /**
     * Create a new event instance.
     *
     * @param  string  $filePath
     * @return void
     */
    public function __construct($filePath)
    {
        $this->filePath = $filePath;
    }
}
