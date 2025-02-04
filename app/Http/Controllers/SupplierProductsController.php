<?php

namespace App\Http\Controllers;

use App\Http\Requests\SupplierProductRequest;
use App\Http\Resources\SupplierProductsResource;
use App\Models\SupplierProduct;
use Illuminate\Http\Request;

class SupplierProductsController extends Controller
{


    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = SupplierProduct::with('suppliers', 'products')->get();
        return response()->json([
            "message" => SupplierProductsResource::collection($data)
        ]);
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
    public function store(SupplierProductRequest $request)
    {
        SupplierProduct::create([
            "supplier_id" => $request->supplier_id,
            "product_id" => $request->product_id,
        ]);
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

            $supplierProduct = SupplierProduct::get();
            $supplierProduct->update([
                "supplier_id" => $request->supplier_id,
                "product_id" => $request->product_id,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                "message" => "ma'lumot o'zgartirishda xatolik" . $e->getMessage()
            ], 400);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $supplierProduct = SupplierProduct::destroy($id);

        return response()->json([
            'message' => $supplierProduct == 0 ? "$id ID li mahsulot ta'minotchisi topilmadi" : "mahsulot ta'minotchisi o'chirildi"
        ]);
    }
}
