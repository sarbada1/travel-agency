<?php

namespace App\Models\Setting;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'sub_name',
        'slogan',
        'email',
        'address',
        'phone',
        'mobile',
        'description',
        'favicon',
        'logo',
        'facebook',
        'twitter',
        'linkedin',
        'instagram',
        'youtube',
        'pinterest',
        'whatsapp',
        'google_plus',
        'meta_title',
        'meta_description',
        'meta_keywords',
        'google_map',
    ];
}
