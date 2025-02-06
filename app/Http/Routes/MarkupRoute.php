<?php

namespace App\Http\Routes;

use App\Http\Controllers\MarkupsController;
use Illuminate\Support\Facades\Route;

class MarkupRoute
{
    public static function routes()
    {
        Route::resource('markup', MarkupsController::class);
    }
}
