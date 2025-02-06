<?php

namespace App\Http\Routes;

use App\Http\Controllers\SupplierProductsController;
use Illuminate\Support\Facades\Route;

class SupplierProductsRoute
{
    public static function routes()
    {
        Route::resource('supplierProduct', SupplierProductsController::class);
    }
}
