<?php

namespace App\Models\Page;

use App\Models\User\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    use HasFactory;

    protected $fillable = [
        'is_published',
        'user_id',
        'parent_id',
        'title',
        'slug',
        'sub_title',
        'icons',
        'image',
        'summary',
        'description',
        'meta_title',
        'meta_description',
        'meta_keywords',
        'page_section_name',
        'website',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');

    }

    public function parent()
    {
        return $this->belongsTo(Page::class, 'parent_id');

    }

    public function child()
    {
        return $this->hasMany(Page::class, 'parent_id');
    }

    public function children()
    {
        return $this->hasMany(Page::class, 'parent_id');
    }




    protected static function booted()
    {
        static::created(function () {
            // Regenerate the sitemap when a post is created
            \Artisan::call('sitemap:generate');
        });

        static::updated(function () {
            // Regenerate the sitemap when a post is updated
            \Artisan::call('sitemap:generate');
        });

        static::deleted(function () {
            // Regenerate the sitemap when a post is deleted
            \Artisan::call('sitemap:generate');
        });
    }


    public function getFaq()
    {
        return $this->hasMany(PageFaq::class, 'parent_id', 'id');

    }

    public function getFaqTable()
    {
        return (new PageFaq())->getTable();
    }
}
