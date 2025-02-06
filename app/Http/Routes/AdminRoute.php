<?php

namespace App\Http\Routes;

use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;

class AdminRoute
{
    public static function routes()
    {
        Route::post('register', [AdminController::class, 'register']);
        Route::post('login', [AdminController::class, 'login']);
    }
}
