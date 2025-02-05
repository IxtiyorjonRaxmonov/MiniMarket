<?php

namespace App\Http\Interface;

use Illuminate\Http\Request;

interface AdminInterface {
    public function register(Request $request):void;
}
