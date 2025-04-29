<?php

namespace App\Models\TourPackage;

use App\Models\User;
use App\Models\Category;
use App\Models\Destination;
use App\Models\Activity;
use App\Models\Booking;
use App\Models\Review;
use App\Traits\HasAttributes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
    
    public function destinations()
    {
        return $this->belongsToMany(Destination::class);
    }
    
    public function activities()
    {
        return $this->belongsToMany(Activity::class)
            ->withPivot('is_optional', 'additional_cost');
    }
    
    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }
    
    public function reviews()
    {
        return $this->morphMany(Review::class, 'reviewable');
    }
}