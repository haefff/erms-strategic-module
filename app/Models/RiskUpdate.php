<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class RiskUpdate extends Model
{
    protected $fillable = [
        'risk_register_id', 'user_id', 'field_changed',
        'old_value', 'new_value', 'remarks',
    ];

    public function risk(): BelongsTo
    {
        return $this->belongsTo(RiskRegister::class, 'risk_register_id');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}