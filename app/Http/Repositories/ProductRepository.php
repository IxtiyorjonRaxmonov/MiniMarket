<?php

namespace App\Http\Repositories;

use App\Http\Interface\ProductInterface;
use App\Models\Product;

class ProductRepository implements ProductInterface
{
    public function index(){
        return Product::select('product_name')->get();

    }

    public function store($request){

        $active = request('active', true);
        Product::create([
            "product_name" => $request->product_name,
            "active" => $active
        ]);
        return  response()->json([
            "message" => "created"
        ]);
    }

    public function update($request, $id)
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

    public function destroy($id)
    {
        $product = Product::destroy($id);

        return response()->json([
            'message' => $product == 0 ? "$id ID li mahsulot topilmadi" : "mahsulot o'chirildi"
        ]);
    }
}
