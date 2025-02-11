<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Action extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function rule() : BelongsTo
    {
        return $this->belongsTo(Rule::class);
    }
}
