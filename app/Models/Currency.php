<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Currency extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function income(): HasMany
    {
        return $this->hasMany(Income::class);
    }

    public function expenditure(): HasMany
    {
        return $this->hasMany(Expenditure::class);
    }
}
