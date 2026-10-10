<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class SubKri extends Model
{
    protected $fillable = ['kri_id', 'code', 'name', 'description'];

    public function kri(): BelongsTo
    {
        return $this->belongsTo(Kri::class);
    }

    public function risks(): HasMany
    {
        return $this->hasMany(RiskRegister::class);
    }
}