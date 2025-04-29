<?php

namespace App\Models\Address;

use App\Models\User\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CountryPage extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'country_id',
        'title',
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

    public function country()
    {
        return $this->belongsTo(Country::class, 'country_id', 'id');
    }

    public function postedBy()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
