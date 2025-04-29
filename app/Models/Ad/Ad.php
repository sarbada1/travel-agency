<?php

namespace App\Models\Ad;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ad extends Model
{
    use HasFactory;

    protected $fillable = [
        'ad_set_id',         // Added to connect to ad set
        'name',
        'type',
        'image_path',
        'image_alt',
        'url',
        'html_content',
        'open_in_new_tab',
        'is_active',
        'status',            // Added from migration
        'headline',          // Added from migration
        'description',       // Added from migration
        'call_to_action',    // Added from migration
        'clicks',            // Added from migration
        'impressions',       // Added from migration
        'start_date',
        'end_date',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'open_in_new_tab' => 'boolean',
        'clicks' => 'integer',
        'impressions' => 'integer',
        'start_date' => 'date',
        'end_date' => 'date',
    ];

    /**
     * Get the ad set that this ad belongs to
     */
    public function adSet()
    {
        return $this->belongsTo(AdSet::class);
    }

    /**
     * Get the campaign associated with this ad through the ad set
     */
    public function campaign()
    {
        return $this->hasOneThrough(Campaign::class, AdSet::class, 'id', 'id', 'ad_set_id', 'campaign_id');
    }

    /**
     * Get the placements for this ad
     */
    public function placements()
    {
        return $this->hasMany(AdPlacement::class);
    }

    /**
     * Get the positions this ad is placed in
     */
    public function positions()
    {
        return $this->belongsToMany(AdPosition::class, 'ad_placements', 'ad_id', 'position_id')
            ->withPivot('priority', 'start_date', 'end_date')
            ->withTimestamps();
    }

    /**
     * Check if this ad is currently valid to be displayed
     */
    public function isValid()
    {
        $today = now()->startOfDay();
        
        if (!$this->is_active || $this->status !== 'active') {
            return false;
        }
        
        if ($this->start_date && $this->start_date->gt($today)) {
            return false;
        }
        
        if ($this->end_date && $this->end_date->lt($today)) {
            return false;
        }
        
        return true;
    }

    /**
     * Get the CTR (Click Through Rate) for this ad
     */
    public function getCtrAttribute()
    {
        if ($this->impressions > 0) {
            return ($this->clicks / $this->impressions) * 100;
        }
        
        return 0;
    }

    /**
     * Increment the impressions count
     */
    public function recordImpression()
    {
        $this->increment('impressions');
    }

    /**
     * Increment the clicks count
     */
    public function recordClick()
    {
        $this->increment('clicks');
    }
}