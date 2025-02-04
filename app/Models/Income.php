<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Income extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function measurement(): BelongsTo
    {
        return $this->belongsTo(Measurement::class);
    }


    public function supplierProduct(): BelongsTo
    {
        return $this->belongsTo(SupplierProduct::class , 'supplier_product_id');
    }

    public function currency(): BelongsTo
    {
        return $this->belongsTo(Currency::class , 'currency_id');
    }


}
