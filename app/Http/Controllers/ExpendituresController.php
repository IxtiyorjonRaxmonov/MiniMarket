<?php

namespace App\Http\Controllers;

use App\Http\Requests\ExpenditureRequest;
use App\Http\Resources\ExpenditureResource;
use App\Models\CurrencyDaily;
use App\Models\Expenditure;
use App\Models\Income;
use App\Models\Markup;
use App\Models\Profit;
use App\Models\RestProduct;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PhpParser\Node\Stmt\TryCatch;

class ExpendituresController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
       return  $data = Expenditure::with(
            'supplierProduct.suppliers:id,company_name',
            'supplierProduct.products:id,product_name',
            'currency'
        )
            ->get();
        return response()->json([

            "message" => ExpenditureResource::collection($data)
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
    public function store(ExpenditureRequest $request)
    {
        DB::beginTransaction();
        try {

            $supplierProductId = $request->supplier_product_id;
            $currencyId = $request->currency_id;
            $quantitySold = $request->quantity_sold;

            $restProduct = RestProduct::where("supplier_product_id", $supplierProductId)->first();
            if (!$restProduct) {
                return response()->json(["message" => "Bu mahsulot hali kirim qilinmagan"], 404);
            }

            if ($restProduct->stock_quantity < $quantitySold) {
                return response()->json(["message" => "Bu mahsulotdan faqat {$restProduct->stock_quantity}  qolgan"], 400);
            }

            $income = Income::where('supplier_product_id', $supplierProductId)->latest()->first();
            $markup = Markup::where('supplier_product_id', $supplierProductId)->latest()->value('markups');
            $currencyValueUSD = CurrencyDaily::where('currency_id', 1)->latest()->value('in_UZS');
            // $currencyValueUZS = CurrencyDaily::where('currency_id', 2)->latest()->value('in_UZS');


            if (!$income || !$markup) {
                return response()->json(["message" => "Kerakli ma'lumotlar topilmadi"], 400);
            }

            $perPurchaseUZS = $income->per_purchase_UZS;
            $perPurchaseUSD = $income->per_purchase_USD;

            $markupAmountUSD = ($perPurchaseUSD * $markup) / 100;
            $markupAmountUZS = ($perPurchaseUZS * $markup) / 100;

            $perSellingPriceUSD = ($perPurchaseUSD + $markupAmountUSD);
            $perSellingPriceUZS = ($perPurchaseUZS + $markupAmountUZS);

            $totalPriceUZS = $perSellingPriceUSD * $quantitySold * $currencyValueUSD;
            $totalPriceUSD = $totalPriceUZS / $currencyValueUSD ;

            $profitUSD = ($totalPriceUSD - ($perPurchaseUSD * $quantitySold));
            $profitUZS = ($profitUSD * $currencyValueUSD);


            Expenditure::create([
                "supplier_product_id" => $supplierProductId,
                "currency_id" => $currencyId,
                "total_price_USD" => $totalPriceUSD,
                "total_price_UZS" => $totalPriceUZS,
                "quantity_sold" => $quantitySold
            ]);

            $restProduct->decrement("stock_quantity", $quantitySold);

            Profit::create([
                "supplier_product_id" => $supplierProductId,
                "in_UZS" => $profitUZS,
                "in_USD" => $profitUSD
            ]);
            DB::commit();
            return response()->json([
                "message" => "Mahsulot sotildi",
                "total_price" => $currencyId == 2 ? $totalPriceUZS : $totalPriceUSD
            ], 200);
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
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
