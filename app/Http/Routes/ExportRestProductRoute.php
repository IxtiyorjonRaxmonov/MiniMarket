<?php

namespace App\Http\Routes;

use App\Http\Controllers\ExportRestProductsController;
use Illuminate\Support\Facades\Route;

class ExportRestProductRoute
{
    public static function routes()
    {
        Route::get('/check-export-status/{id}', [ExportRestProductsController::class, 'checkExportStatus']);
        Route::post('rest_products_export', [ExportRestProductsController::class, 'export']);
    }
}
