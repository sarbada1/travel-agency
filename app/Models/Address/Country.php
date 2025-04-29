<?php

namespace App\Models\Address;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    use HasFactory;

    protected $fillable = [
        'continent_id',
        'code',
        'country_name',
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

    public function continent()
    {
        return $this->belongsTo(Continents::class, 'continent_id', 'id');

    }

    public function locations()
    {
        return $this->hasMany(Location::class, 'country_id', 'id');
    }

    public function pages()
    {
        return $this->hasMany(CountryPage::class, 'country_id', 'id');
    }


    public function getFaq()
    {
        return $this->hasMany(CountryFaq::class, 'parent_id', 'id');

    }

    public function getFaqTable()
    {
        return (new CountryFaq())->getTable();
    }


    public function getContent()
    {
        return $this->hasMany(CountryContent::class, 'parent_id', 'id');
    }



}
