<?php

namespace App\Http\Interface;

use App\Http\Requests\UserRegisterRequest;
use Illuminate\Http\Request;

interface AdminInterface {
    public function register($request);
    public function login($request);
}
