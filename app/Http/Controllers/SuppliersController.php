<?php

namespace App\Http\Controllers;

use App\Http\Requests\SupplierRequest;
use App\Models\Supplier;
use App\Models\SupplierProduct;
use Illuminate\Http\Request;

class SuppliersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Supplier::select('company_name')->get();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SupplierRequest $request)
    {
        $active = request('active', true);
        Supplier::create([
           "company_name" => $request->company_name,
           "active" => $active
        ]);
        return response()->json([
            "message" => "created"
        ],200);
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            
            $active = request('active', true);
            $supplier = Supplier::find($id);
            $supplier::update([
               "company_name" => $request->company_name,
               "active" => $active
            ]);
            return response()->json([
                "message" => "malumot o'zgartirildi"
            ],200);
        } catch (\Exception $e) {
            return response()->json([
                "message" => "ma'lumot o'zgartirishda xatolik" . $e->getMessage()
            ],400);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $supplier = Supplier::destroy($id);

        return response()->json([
            'message' => $supplier == 0 ? "$id ID li ta'minotchi topilmadi" : "ta'minotchi o'chirildi"
        ]);;
    }
}
