<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ExpenditureResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "SupplierCompany" => $this->supplierProduct->suppliers->company_name,
            "Product" => $this->supplierProduct->products->product_name,
            "Currency" => $this->currency->currency_name,
            "TotalUZS" => $this->total_price_UZS,
            "TotalUSD" => $this->total_price_USD,
            "QuantitySold" => $this->quantity_sold,
            "Measure" => $this->quantity_sold,

        ];
    }
}
