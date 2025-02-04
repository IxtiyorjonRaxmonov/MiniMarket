<?php

namespace App\Http\Controllers;

use App\Models\Currency;
use Illuminate\Http\Request;

class CurrenciesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Currency::select('currency_name')->get();
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
    public function store(Request $request)
    {
        Currency::create([
            "currency_name" => $request->currency_name,
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
            $currency = Currency::find($id);
            $currency->update([
                "currency_name" => $request->currency_name,
                "active" => $request->active,
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
        $currency = Currency::destroy($id);

        return response()->json([
            'message' => $currency == 0 ? "$id ID li valuta topilmadi" : "Valuta o'chirildi"
        ]);
    }
}
