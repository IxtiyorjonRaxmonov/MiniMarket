<?php

namespace App\Http\Routes;

use App\Http\Controllers\MeasurementsController;
use Illuminate\Support\Facades\Route;

class MeasurementRoute
{

    public static function routes()
    {
        Route::resource('measurement', MeasurementsController::class);
    }
}
