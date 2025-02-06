<?php

namespace App\Http\Routes;

use App\Http\Controllers\ExpendituresController;
use Illuminate\Support\Facades\Route;

class ExpenditureRoute
{
    public static function routes()
    {
        Route::resource('expenditure', ExpendituresController::class);
    }
}
