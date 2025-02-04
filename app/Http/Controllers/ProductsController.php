<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Product::select('product_name')->get();
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
    public function store(ProductRequest $request)
    {
        $active = request('active', true);
        Product::create([
            "product_name" => $request->product_name,
            "active" => $active
        ]);
        return  response()->json([
            "message" => "created"
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
            $active = request('active', true);
            $product = Product::find($id);
            $product->update([
                "product_name" => $request->product_name,
                "active" => $active
            ]);
            return  response()->json([
                "message" => "updated"
            ]);
        } catch (\Exception $e) {
            return response()->json([
                "message" => "ma'lumot o'zgartirishda xatolik" . " " . $e->getMessage()
            ], 400);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $product = Product::destroy($id);

        return response()->json([
            'message' => $product == 0 ? "$id ID li mahsulot topilmadi" : "mahsulot o'chirildi"
        ]);
    }
}
