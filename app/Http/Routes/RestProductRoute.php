<?php

namespace App\Http\Routes;

use App\Http\Controllers\RestProductsController;
use Illuminate\Support\Facades\Route;

class RestProductRoute
{
    public static function routes()
    {
        Route::resource('restProduct', RestProductsController::class);
    }
}
