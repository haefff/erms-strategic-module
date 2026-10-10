<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class KriApproval extends Model
{
    protected $fillable = [
        'risk_register_id', 'kri_id', 'sub_kri_id',
        'submitted_by', 'reviewed_by',
        'status', 'remarks', 'submitted_at', 'reviewed_at',
    ];

    protected $casts = [
        'submitted_at' => 'datetime',
        'reviewed_at'  => 'datetime',
    ];

    public function risk(): BelongsTo
    {
        return $this->belongsTo(RiskRegister::class, 'risk_register_id');
    }

    public function kri(): BelongsTo
    {
        return $this->belongsTo(Kri::class);
    }

    public function subKri(): BelongsTo
    {
        return $this->belongsTo(SubKri::class);
    }

    public function submitter(): BelongsTo
    {
        return $this->belongsTo(User::class, 'submitted_by');
    }

    public function reviewer(): BelongsTo
    {
        return $this->belongsTo(User::class, 'reviewed_by');
    }
}