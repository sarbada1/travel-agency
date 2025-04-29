<?php

namespace App\Models\Address;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CountryContent extends Model
{
    use HasFactory;

    protected $fillable = [
        'parent_id',
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
    ];

    public function country()
    {
        return $this->belongsTo(Country::class, 'parent_id', 'id');
    }
}
