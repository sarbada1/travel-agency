<?php

namespace App\Models\Address;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'country_id',
        'name',
        'slug',
        'sub_title',
        'is_published',
        'icons',
        'image',
        'summary',
        'description',
        'meta_title',
        'meta_description',
        'meta_keywords',
        'website',
    ];
}
