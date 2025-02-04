<?php

namespace App\Http\Controllers;

use App\Http\Requests\MarkupRequest;
use App\Http\Resources\MarkupsResource;
use App\Models\Markup;
use Illuminate\Http\Request;

class MarkupsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Markup::with('supplierProduct.suppliers', 'supplierProduct.products')->get();
        return response()->json([
            "message" => MarkupsResource::collection($data)
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
    public function store(MarkupRequest $request)
    {
        Markup::create([
            "supplier_product_id" => $request->supplier_product_id,
            "markup" => $request->markup
        ]);
        return response()->json([
            "message" => "crated"
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
            $markup = Markup::find($id);
            $markup->update([
                "supplier_product_id" => $request->supplier_product_id,
                "markups" => $request->markup
            ]);

            return response()->json([
                "message" => "updated"
            ]);
        } catch (\Exception $e) {
            return response()->json([
                "message" => "ma'lumot o'zgartirishda xatolik" . " " . $e->getMessage()
            ], 400);
        }
    }
    /**rekwjhi
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $markup = Markup::destroy($id);

        return response()->json([
            'message' => $markup == 0 ? "$id ID li ustama topilmadi" : "ustama o'chirildi"
        ]);
    }
}
