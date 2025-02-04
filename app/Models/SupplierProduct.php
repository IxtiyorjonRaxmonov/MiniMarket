<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class SupplierProduct extends Model
{
    use HasFactory;
    protected $table = 'suppliers_products';

    public function suppliers(): BelongsTo
    {
        return $this->belongsTo(Supplier::class, 'supplier_id');
    }


    public function products(): BelongsTo
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

    public function restProduct(): HasMany
    {
        return $this->hasMany(RestProduct::class);
    }

    public function expenditure(): HasMany
    {
        return $this->hasMany(Expenditure::class);
    }

    public function income(): HasMany
    {
        return $this->hasMany(Income::class);
    }

    public function markup(): HasMany
    {
        return $this->hasMany(Markup::class);
    }

    public function profit(): HasMany
    {
        return $this->hasMany(Profit::class);
    }
}
