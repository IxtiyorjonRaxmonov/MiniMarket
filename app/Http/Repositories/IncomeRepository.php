<?php

namespace App\Http\Repositories;

use App\Http\Interface\ExpenditureInterface;
use App\Http\Interface\IncomeInterface;
use App\Http\Resources\IncomeResource;
use App\Imports\ImportIncomeExcel;
use App\Jobs\ImportIncomeExcelJob;
use App\Models\CurrencyDaily;
use App\Models\Income;
use App\Models\RestProduct;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Facades\Excel;

class IncomeRepository implements IncomeInterface
{

    public function incomeExcel($request)
    {
        try {
            
            $request->validate([
                "file" => "required|file"
            ]); 
    
            $filePath = $request->file('file')->store('imports');
    
            ImportIncomeExcelJob::dispatch($filePath);
           
    
            return response()->json([
                "message" => "kiritilgan ma'lumotlar databazaga saqlandi"
            ]);
        } catch (\Throwable $th) {
            throw $th;
        }
        
    }


    public function index()
    {
        $data = Income::with(
            'measurement',
            'supplierProduct.suppliers',
            'supplierProduct.products',
            'currency'
        )
            ->get();
        return response()->json([
            "message" => IncomeResource::collection($data)
        ]);
    }

    public function store($request)
    {
        DB::beginTransaction();
        try {

            $currencyId = $request->currency_id;
            $currencyValue = CurrencyDaily::where('currency_id', $currencyId)
                ->latest()
                ->value('in_UZS');
            $currencyValueUSD = CurrencyDaily::where('currency_id', "!=", $currencyId)
                ->latest()
                ->value('in_UZS');

            $per_purchase_USD = $request->per_purchase_USD;
            $per_purchase_UZS = $request->per_purchase_UZS;

            Income::create([
                "supplier_product_id" => $request->supplier_product_id,
                "currency_id" => $currencyId,
                "per_purchase_USD" => $per_purchase_USD ? $per_purchase_USD : $per_purchase_UZS / $currencyValueUSD,
                "per_purchase_UZS" => $per_purchase_UZS ? $per_purchase_UZS : $per_purchase_USD * $currencyValue,
                "measurement_id" => $request->measurement_id,
                "quantity" => $request->quantity,
                "remaining_quantity" => $request->quantity
            ]);

            $restProduct = RestProduct::where("supplier_product_id", $request->supplier_product_id)->first();
            if ($restProduct) {
                $restProduct->increment('stock_quantity', $request->quantity);
            } else {
                RestProduct::create([
                    "supplier_product_id" => $request->supplier_product_id,
                    "stock_quantity" => $request->quantity
                ]);
            }

            DB::commit();

            $totalPrice = $per_purchase_USD
                ? $per_purchase_USD * $request->quantity
                : $per_purchase_UZS * $request->quantity;


            return response()->json([
                "message" => "Mahsulot kiritildi. Jami narxi: $totalPrice"
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                "error" => "Xatolik yuz berdi: " . $e->getMessage()
            ], 500);
        }
    }
}
