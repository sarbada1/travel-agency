<?php

namespace App\Models\Ad;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdSet extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'campaign_id',
        'name',
        'status',
        'budget_type',
        'budget_amount',
        'start_date',
        'end_date',
        'bid_strategy',
        'bid_amount',
        'targeting_specs',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'start_date' => 'datetime',
        'end_date' => 'datetime',
        'budget_amount' => 'float',
        'bid_amount' => 'float',
        'targeting_specs' => 'json',
    ];

    /**
     * Get the campaign that owns the ad set.
     */
    public function campaign()
    {
        return $this->belongsTo(Campaign::class);
    }

    /**
     * Get the ads for the ad set.
     */
    public function ads()
    {
        return $this->hasMany(Ad::class);
    }
}