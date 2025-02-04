<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MarkupsResource extends JsonResource
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
            "Markup" => $this->markups
        ];
    }
}
