<?php

namespace App\Http\Routes;

use App\Http\Controllers\SuppliersController;
use Illuminate\Support\Facades\Route;

class SuppliersRoute
{
    public static function routes()
    {
        Route::resource('supplier', SuppliersController::class);
    }
}
