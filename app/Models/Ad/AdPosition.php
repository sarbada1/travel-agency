<?php

namespace App\Models\Ad;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdPosition extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'identifier',
        'description',
    ];

    public function placements()
    {
        return $this->hasMany(AdPlacement::class, 'position_id');
    }

    public function ads()
    {
        return $this->belongsToMany(Ad::class, 'ad_placements', 'position_id', 'ad_id')
            ->withPivot('priority')
            ->withTimestamps();
    }
}