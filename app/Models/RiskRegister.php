<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class RiskRegister extends Model
{
    use HasFactory;

    protected $fillable = [
        'ptj_id', 'risk_number', 'year', 'risk_description', 'risk_owner',
        'registered_date', 'updated_date',
        'likelihood', 'human_impact', 'reputation_impact', 'financial_impact',
        'operational_impact', 'objective_impact',
        'average_score', 'risk_index', 'risk_level',
        'existing_controls', 'proposed_controls',
        'status', 'category', 'marker', 'classification',
        'is_high_impact', 'high_impact_set_by', 'high_impact_set_at',
        'kri_id', 'sub_kri_id', 'import_hash',
    ];

    protected $casts = [
        'registered_date'    => 'date',
        'updated_date'       => 'date',
        'is_high_impact'     => 'boolean',
        'high_impact_set_at' => 'datetime',
        'average_score'      => 'decimal:2',
        'risk_index'         => 'decimal:2',
    ];

    public function ptj(): BelongsTo
    {
        return $this->belongsTo(Ptj::class);
    }

    public function kri(): BelongsTo
    {
        return $this->belongsTo(Kri::class);
    }

    public function subKri(): BelongsTo
    {
        return $this->belongsTo(SubKri::class);
    }

    public function highImpactSetBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'high_impact_set_by');
    }

    public function updates(): HasMany
    {
        return $this->hasMany(RiskUpdate::class);
    }

    public function approvals(): HasMany
    {
        return $this->hasMany(KriApproval::class);
    }

    public function latestApproval(): HasOne
    {
        return $this->hasOne(KriApproval::class)->latestOfMany();
    }
}