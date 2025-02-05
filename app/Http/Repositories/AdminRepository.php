<?php

namespace App\Http\Repositories;

use App\Http\Interface\AdminInterface;
use App\Models\Users;
use Illuminate\Http\Request;

class AdminRepository  implements AdminInterface
{
    public function register(Request $request): void {
        Users::create([
            'name' => $request->name,
            'surname' => $request->surname,
            'username' => $request->username,
            'password' => bcrypt($request->password)
        ]);
    }
}
