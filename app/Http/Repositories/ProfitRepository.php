<?php

namespace App\Http\Repositories;

use App\Http\Interface\ProductInterface;
use App\Http\Interface\ProfitInterface;
use App\Models\Product;
use App\Models\Profit;
use PhpOffice\PhpSpreadsheet\Calculation\MathTrig\Sum;

class ProfitRepository implements ProfitInterface
{
    public function index($request)
    {
        
        
            $supplier_product_id = $request->supplier_product_id;
            $currency = $request->currency;
        
            if (!in_array($currency, ['UZS', 'USD'])) {
                return response()->json(['error' => 'Invalid currency. Use "UZS" or "USD".'], 400);
            }
        
            $column = $currency === 'UZS' ? 'in_UZS' : 'in_USD';
        
            $profit = Profit::when($supplier_product_id, function ($query) use ($supplier_product_id) {
                    return $query->where('supplier_product_id', $supplier_product_id);
                })
                ->sum($column);
        
            return response()->json(['total' => $profit, 'currency' => $currency]);
        
        
    }

    public function indexTotal($request)
    {
            $supplier_product_id = request('supplier_product_id', null);
        
            $profit = Profit::where('supplier_product_id', $supplier_product_id ? $supplier_product_id : "!=", $supplier_product_id);
        
            $totalUZS = $profit->sum('in_UZS');
            $totalUSD = $profit->sum('in_USD');
        
            return response()->json([
                'total_UZS' => $totalUZS,
                'total_USD' => $totalUSD
            ]);
        
        
        
    }
}
