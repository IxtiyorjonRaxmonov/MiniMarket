<?php

namespace App\Http\Routes;

use App\Http\Controllers\ProfitsController;
use Illuminate\Support\Facades\Route;

class ProfitRoute
{
    public static function routes() {
        Route::get('profit', [ProfitsController::class, 'index']);
        Route::get('profitTotal', [ProfitsController::class, 'indexTotal']);
    }
}
