<?php

namespace App\Http\Controllers;

use App\Http\Interface\ProductInterface;
use App\Http\Requests\ProductRequest;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    public function __construct(private ProductInterface $productInterface)
    {
        
    }
  

    public function index()
    {
        return response()->json([
            $this->productInterface->index()
        ]);
    }

    
    public function store(ProductRequest $request)
    {
        return response()->json([
            $this->productInterface->store($request)
        ]);
    }


    public function update(ProductRequest $request, string $id)
    {
        return response()->json([
            $this->productInterface->update($request, $id)
        ]);
    }

    
    public function destroy(string $id)
    {
        return response()->json([
            $this->productInterface->destroy($id)
        ]);
    }
}
