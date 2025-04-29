<?php

namespace App\Models\Ad;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CampaignMetric extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'campaign_id',
        'impressions',
        'clicks',
        'ctr',
        'spend',
        'conversions',
        'cost_per_result',
        'reach',
        'date',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'date' => 'date',
        'ctr' => 'float',
        'spend' => 'float',
        'cost_per_result' => 'float',
    ];

    /**
     * Get the campaign that owns the metric.
     */
    public function campaign()
    {
        return $this->belongsTo(Campaign::class);
    }
}