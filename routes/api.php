<?php

use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\CurrenciesController;
use App\Http\Controllers\ExpendituresController;
use App\Http\Controllers\ExportRestProductsController;
use App\Http\Controllers\IncomesController;
use App\Http\Controllers\MarkupsController;
use App\Http\Controllers\MeasurementsController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\RestProductsController;
use App\Http\Controllers\SupplierProductsController;
use App\Http\Controllers\SuppliersController;
use Illuminate\Http\Request;
use Illuminate\Routing\Route as RoutingRoute;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Route::middleware(['auth:sanctum'])->group(function () {
Route::post('rest_products_export', [ExportRestProductsController::class, 'export']);
Route::resource('expenditure', ExpendituresController::class);
Route::resource('income', IncomesController::class);
Route::resource('markup', MarkupsController::class);
Route::resource('measurement', MeasurementsController::class);
Route::resource('product', ProductsController::class);
Route::resource('restProduct', RestProductsController::class);
Route::resource('supplierProduct', SupplierProductsController::class);
Route::resource('supplier', SuppliersController::class);
Route::resource('currency', CurrenciesController::class);

// });