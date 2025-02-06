<?php

namespace App\Http\Repositories;

use App\Http\Interface\CurrencyInterface;
use App\Models\Currency;

class CurrencyRepository implements CurrencyInterface{

    public function index(){
        return Currency::select('currency_name')->get();
        
    }

    public function store($request){
        Currency::create([
            "currency_name" => $request->currency_name,
        ]);
    }

    public function update($request, $id){
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

    public function destroy($id){
        $currency = Currency::destroy($id);

        return response()->json([
            'message' => $currency == 0 ? "$id ID li valuta topilmadi" : "Valuta o'chirildi"
        ]);
    }
}