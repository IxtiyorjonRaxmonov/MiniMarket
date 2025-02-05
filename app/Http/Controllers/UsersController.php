<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Users;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return User::get();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
       
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Users::create([
        //     'name' => $request->name,
        //     'surname' => $request->surname,
        //     'username' => $request->username,
        //     'password' => bcrypt($request->password)
        // ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //        return 555;

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $user = Users::find($id);
        $user->update([
            'name' => $request->name,
            'surname' => $request->surname,
            'username' => $request->username,
            'password' => bcrypt($request->password),
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        
        $user = Users::destroy($id);

        return response()->json([
            'message' => $user == 0 ? "$id ID li foydalanuvchi topilmadi" : "foydalanuvchi o'chirildi"
        ]);
    }
}
