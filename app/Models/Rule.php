<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Rule extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function module() : HasMany
    {
        return $this->hasMany(Module::class);
    }

    public function action() : HasMany
    {
        return $this->hasMany(Action::class);
    }

    public function userRule() : BelongsTo
    {
        return $this->belongsTo(UserRule::class);
    }
}
