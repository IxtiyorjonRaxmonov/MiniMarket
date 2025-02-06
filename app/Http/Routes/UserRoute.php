<?php

namespace App\Http\Routes;

use App\Http\Controllers\UsersController;
use Illuminate\Support\Facades\Route;

class UserRoute
{
    public static function routes()
    {
        Route::resource('user', UsersController::class);
    }
}
