<?php

namespace App\Models\Ad;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdPlacement extends Model
{
    use HasFactory;

    protected $fillable = [
        'ad_id',
        'position_id',
        'priority',
    ];

    public function ad()
    {
        return $this->belongsTo(Ad::class);
    }

    public function position()
    {
        return $this->belongsTo(AdPosition::class);
    }
}