<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Profit extends Model
{
    use HasFactory;
    protected $guarded = [];
    
    public function supplierProduct(): BelongsTo
    {
        return $this->belongsTo(SupplierProduct::class, 'supplier_product_id');
    }
}
