<?php

namespace App\Http\Controllers;

use App\Http\Requests\IncomeRequest;
use App\Http\Resources\IncomeResource;
use App\Models\CurrencyDaily;
use App\Models\Income;
use App\Models\RestProduct;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;




class IncomesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Income::with(
            'measurement', 
            'supplierProduct.suppliers', 
            'supplierProduct.products', 
            'currency')
            ->get();
            return response()->json([
                "message" => IncomeResource::collection($data)
            ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create() {}

    /**
     * Store a newly created resource in storage.
     */
    public function store(IncomeRequest $request)
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
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
