<?php

namespace App\Http\Routes;

use App\Http\Controllers\IncomesController;
use Illuminate\Support\Facades\Route;

class IncomesRoute
{
    public static function routes()
    {
        Route::resource('income', IncomesController::class);
    }
}
