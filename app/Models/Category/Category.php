<?php

namespace App\Models\Category;

use App\Models\Attribute\Attribute;
use App\Models\User\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'parent_id',
        'name',
        'slug',
        'icon',
        'sub_title',
        'description',
        'status',
        'image',
        'page_type',
        'is_main',
        'meta_title',
        'meta_description',
        'meta_keywords',
    ];
    const TYPE_REAL_ESTATE = 'real-estate';
    const TYPE_HOTEL = 'hotels';
    const TYPE_JOB = 'jobs';
    const TYPE_VEHICLE = 'vehicles';
    const TYPE_CONSULTANCY = 'consultancy';
    const TYPE_DEFAULT = 'default';
    
    public static function getPageTypes()
    {
        return [
            self::TYPE_REAL_ESTATE => 'Real Estate',
            self::TYPE_HOTEL => 'Hotel',
            self::TYPE_JOB => 'Job',
            self::TYPE_VEHICLE => 'Vehicle',
            self::TYPE_CONSULTANCY => 'Consultancy',
            self::TYPE_DEFAULT => 'Default'
        ];
    }
   
    public function postedBy()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function parent()
    {
        return $this->belongsTo(Category::class,'parent_id');
    }

    public function child()
    {
        return $this->hasMany(Category::class,'parent_id','id');
    }

    public function children()
    {
        return $this->hasMany(Category::class,'parent_id','id');
    }
    public function attributes()
    {
        return $this->belongsToMany(
            \App\Models\TourPackage\PackageAttribute::class, 
            'category_attributes', 
            'category_id', 
            'package_attribute_id'
        )->withPivot('is_required',  'is_featured', 'display_order')
         ->withTimestamps();
    }

    public function getEffectivePageType()
    {
        if ($this->page_type) {
            return $this->page_type;
        }
        
        if ($this->parent_id) {
            return $this->parent ? $this->parent->getEffectivePageType() : self::TYPE_DEFAULT;
        }
        
        return self::TYPE_DEFAULT;
    }
    
    public function getMainCategory()
    {
        if ($this->is_main) {
            return $this;
        }
        
        if ($this->parent_id && $this->parent && $this->parent->is_main) {
            return $this->parent;
        }
        
        if ($this->parent_id && $this->parent) {
            return $this->parent->getMainCategory();
        }
        
        return $this;
    }

    public function subcategories()
    {
        return $this->hasMany(Category::class, 'parent_id');
    }

    /**
     * Get the items associated with this category
     */
    public function items()
    {
        return $this->hasMany(\App\Models\Item\Item::class);
    }

}
