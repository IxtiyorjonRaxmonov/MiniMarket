<?php

use App\Http\Routes\AdminRoute;
use App\Http\Routes\CurrencyRoute;
use App\Http\Routes\ExpenditureRoute;
use App\Http\Routes\ExportRestProductRoute;
use App\Http\Routes\IncomesRoute;
use App\Http\Routes\MarkupRoute;
use App\Http\Routes\MeasurementRoute;
use App\Http\Routes\ProductRoute;
use App\Http\Routes\ProfitRoute;
use App\Http\Routes\RestProductRoute;
use App\Http\Routes\SupplierProductsRoute;
use App\Http\Routes\SuppliersRoute;
use App\Http\Routes\UserRoute;
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
AdminRoute::routes();
Route::middleware(['auth:sanctum'])->group(function () {
    UserRoute::routes();
    ProductRoute::routes();
    ExportRestProductRoute::routes();
    ExpenditureRoute::routes();
    MeasurementRoute::routes();
    IncomesRoute::routes();
    MarkupRoute::routes();
    RestProductRoute::routes();
    SuppliersRoute::routes();
    ProfitRoute::routes();
});


Route::middleware(['auth','admin'])->group(function () {
    SupplierProductsRoute::routes();
    CurrencyRoute::routes();
});

// Route::middleware(['auth:api', 'admin'])->group(function () {

// SupplierProductsRoute::routes();
// CurrencyRoute::routes();
// });

// Route::get('admin','/test', function () {
//     return response('Route is working!');
// });
