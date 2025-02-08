<?php

namespace App\Http\Repositories;

use App\Http\Interface\AdminInterface;
use App\Http\Requests\UserRegisterRequest;
use App\Http\Utils\UserRegiserTrait;
use App\Models\Users;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminRepository  implements AdminInterface
{
    // use UserRegiserTrait;
    public function register($request)
    {
        DB::beginTransaction();
        try {
            // $gotUsername = Users::where('username', $request->username)->exists();
            // if ($gotUsername) {
            //     return response()->json(['message' => "Kiritilgan username allaqachon mavjud"], 409);
            // }
            Users::create([
                'name' => $request->name,
                'surname' => $request->surname,
                'username' => $request->username,
                'role_id' => $request->role_id,
                'password' => bcrypt($request->password)
            ]);
            // $response =  $this->condtion($request->username);
            DB::commit();
            return response()->json(['message' => "User yaratildi"], 200);
        } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json([
                'message' => "Qandaydur xatolik",
                'error' => $th->getMessage() 
        ], 409);
        }
    }

    public function login($request)
    {
        $validated = $request->validate([
            'username' => 'required|string',
            'password' => 'required|string'
        ]);

        try {
            
            $user = Users::where('username', $validated['username'])->first();
    
            if ($user && Hash::check($validated['password'], $user->password)) {
                $token = $user->createToken("mini-market")->plainTextToken;
    
                return response()->json(['token' => $token], 200);
            }
    
            return response()->json(['message' => 'Invalid username or password'], 400);
        } catch (\Throwable $th) {
            
            return response()->json(['message' => $th->getMessage()], 409);

        }
    }
}
