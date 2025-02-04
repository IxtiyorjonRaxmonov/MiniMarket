<?php

namespace App\Exports;

use App\Models\RestProduct;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class RestProductExport implements FromCollection, WithHeadings
{
    /**
     * @return \Illuminate\Support\Collection
     */
    protected $startDate;
    protected $endDate;

    public function __construct($startDate, $endDate)
    {
        $this->startDate = $startDate;
        $this->endDate = $endDate;
    }
    public function collection()
    {
        return RestProduct::with('supplierProduct.suppliers', 'supplierProduct.products')
            ->whereBetween('rest_products.created_at', [$this->startDate, $this->endDate])->get()->map(function ($restProducts) {

                return [
                    'Supplier' => $restProducts->supplierProduct->suppliers->company_name,
                    'Product' => $restProducts->supplierProduct->products->product_name,
                    'Stock Quantity' => $restProducts->stock_quantity,
                    'Created At' => $restProducts->created_at ? $restProducts->created_at->format('Y-m-d H:i:s') : 'No Date'
                ];
            });
    }

    public function headings(): array
    {
        return [
            'Supplier',
            'Product',
            'Stock Quantity',
            'Created At'
        ];
    }
}
