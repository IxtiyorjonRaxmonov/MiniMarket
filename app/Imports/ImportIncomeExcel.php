<?php

namespace App\Imports;

use App\Models\Income;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ImportIncomeExcel implements ToCollection, WithHeadingRow
{
    /**
     * @param Collection $collection
     */
    public function collection(Collection $rows)
    {
        foreach ($rows as $row) {
            Income::create([
                'supplier_product_id' => $row['supplier_product_id'],
                'currency_id' => $row['currency_id'],
                'per_purchase_UZS' => $row['per_purchase_uzs'],
                'per_purchase_USD' => $row['per_purchase_usd'],
                'measurement_id' => $row['measurement_id'],
                'quantity' => $row['quantity'],
            ]);
        }
    }
}
