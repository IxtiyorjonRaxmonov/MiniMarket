<?php
namespace App\Http\Repositories;

use App\Http\Interface\UserInterface;
use App\Models\Users;

class UserRepository implements UserInterface
{
    public function index()
    {
        return Users::get();
    }

    public function update($request, $id)
    {
        $user = Users::find($id);
        $user->update([
            'name' => $request->name,
            'surname' => $request->surname,
            'username' => $request->username,
            'password' => bcrypt($request->password),
        ]);
        return response()->json([
            "message"=>"foydalanuvchi ma'lumotlari o'zgartirildi"
        ]);
    }

    public function destroy($id)
    {
        $user = Users::destroy($id);

        return response()->json([
            'message' => $user == 0 ? "$id ID li foydalanuvchi topilmadi" : "foydalanuvchi o'chirildi"
        ]);
    }
}


