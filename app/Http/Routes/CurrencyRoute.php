<?php

namespace App\Http\Routes;

use App\Http\Controllers\CurrenciesController;
use Illuminate\Support\Facades\Route;

class CurrencyRoute
{
    public static function routes()
    {
        Route::resource('currency', CurrenciesController::class);
    }
}
