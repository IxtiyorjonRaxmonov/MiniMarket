<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CurrencyDaily extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $table = 'currency_daily';
    
    public function currency(): BelongsTo
    {
        return $this->belongsTo(Currency::class, 'currency_id');
    }
}
