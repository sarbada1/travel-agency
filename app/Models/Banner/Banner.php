<?php

namespace App\Models\Banner;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Banner extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'button_text',
        'button_url',
        'image',
        'video',
        'media_type', // Add this field
        'position',
        'is_active',
        'sort_order'
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];
    
    public static function positions()
    {
        return [
            'home_hero' => 'Home Hero Slider',
            'home_sidebar' => 'Home Sidebar', 
            'about_page' => 'About Page Banner',
            'contact_page' => 'Contact Page Banner',
            'blog_sidebar' => 'Blog Sidebar'
        ];
    }
    
    public static function mediaTypes()
    {
        return [
            'image' => 'Image',
            'video' => 'Video'
        ];
    }
}