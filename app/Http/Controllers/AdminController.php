<?php

namespace App\Http\Controllers;

use App\Http\Interface\AdminInterface;
use App\Http\Requests\UserRegisterRequest;
use App\Http\Utils\UserRegiserTrait;
use App\Models\Users;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller 
{
    public function  __construct(private AdminInterface $adminRepo)
    {
        
    }
    public function register(UserRegisterRequest $request){
        
        return $this->adminRepo->register($request);
    }

    public function login(Request $request){
        return response()->json([
            $this->adminRepo->login($request)
        ]);
    }
}
