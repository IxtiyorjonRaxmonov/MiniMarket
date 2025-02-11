<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class UserRule extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function rule() : HasMany
    {
        return $this->hasMany(Rule::class);
    }

    public function user() : HasMany
    {
        return $this->hasMany(Users::class);
    }
}
