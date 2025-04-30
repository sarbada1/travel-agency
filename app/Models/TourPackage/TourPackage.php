<?php

namespace App\Models\TourPackage;

use App\Models\User\User;

use App\Traits\HasAttributes;
use App\Models\Category\Category;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TourPackage extends Model
{
    use HasFactory, HasAttributes;
    
    protected $fillable = [
        'name', 'slug', 'short_description', 'description', 'duration_days',
        'regular_price', 'sale_price', 'currency', 'difficulty_level',
        'group_size', 'user_id', 'featured_image', 'gallery_images',
        'is_featured', 'is_popular', 'status'
    ];
    
    protected $casts = [
        'gallery_images' => 'array',
        'is_featured' => 'boolean',
        'is_popular' => 'boolean',
    ];
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }
    public function attributeValues()
    {
        return $this->morphMany(AttributeValue::class, 'attributable');
    }
    
    // public function bookings()
    // {
    //     return $this->hasMany(Booking::class);
    // }
    
    // public function reviews()
    // {
    //     return $this->morphMany(Review::class, 'reviewable');
    // }
}