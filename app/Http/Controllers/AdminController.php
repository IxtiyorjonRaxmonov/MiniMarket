<?php

namespace App\Http\Controllers;

use App\Http\Interface\AdminInterface;
use App\Models\Users;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller 
{
    public function  __construct(private AdminInterface $adminRepo)
    {
        
    }
    public function register(Request $request):void{
        $this->adminRepo->register($request);
    }

    public function login(Request $request){
        $validated = $request->validate([
            'username' => 'required|string',
            'password' => 'required|string'
        ]);

        $user = Users::where('username', $validated['username'])->first();

        if ($user && Hash::check($validated['password'], $user->password)) {
            $token = $user->createToken("my-education")->plainTextToken;

            return response()->json(['token' => $token], 200);
        }

        return response()->json(['message' => 'Invalid username or password'], 400);
    }
}
