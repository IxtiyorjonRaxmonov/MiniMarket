<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Product extends Model
{
    use HasFactory;
    protected $guarded = [];
 
    public function supplierProduct(): HasMany
    {
        return $this->hasMany(SupplierProduct::class);
    }

    public function categories(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

}
