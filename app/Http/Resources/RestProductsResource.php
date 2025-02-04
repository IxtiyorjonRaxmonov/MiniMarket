<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class RestProductsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'company_name'=>$this->supplierProduct->suppliers->company_name,
            'product'=>$this->supplierProduct->products->product_name,
            'stock_quantity'=>$this->stock_quantity,
            'created_at'=>$this->created_at,
            
        ];
    }
}
