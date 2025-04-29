<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PropertyTour extends Model
{
    use HasFactory;

    protected $fillable = [
        'item_id',
        'user_id',
        'name',
        'email',
        'phone',
        'tour_date',
        'tour_time',
        'tour_type',
        'status'
    ];

    protected $attributes = [
        'status' => 'pending'
    ];

    public function property()
    {
        return $this->belongsTo(\App\Models\Item\Item::class, 'item_id');
    }

    public function user()
    {
        return $this->belongsTo(\App\Models\User\User::class);
    }
}