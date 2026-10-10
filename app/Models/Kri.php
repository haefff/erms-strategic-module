<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Kri extends Model
{
    protected $fillable = ['number', 'name', 'description'];

    public function subKris(): HasMany
    {
        return $this->hasMany(SubKri::class);
    }

    public function risks(): HasMany
    {
        return $this->hasMany(RiskRegister::class);
    }
}