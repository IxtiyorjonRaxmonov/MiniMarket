<?php

namespace App\Http\Routes;

use App\Http\Controllers\ProductsController;
use Illuminate\Support\Facades\Route;


class ProductRoute
{
    public static function routes()
    {
        Route::resource('product', ProductsController::class);
    }
}
