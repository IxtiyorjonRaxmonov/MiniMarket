<?php

namespace App\Http\Controllers;

use App\Http\Interface\UserInterface;
use App\Models\User;
use App\Models\Users;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    public function __construct(private UserInterface $userInterface)
    {

    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json([
            $this->userInterface->index()
        ]);
    }


    public function update(Request $request, string $id)
    {
       return response()->json([
        $this->userInterface->update($request, $id)
       ]);
    }

    
    
    public function destroy(string $id)
    {
        
       return response()->json([
        $this->userInterface->destroy($id)
       ]);
    }
}
