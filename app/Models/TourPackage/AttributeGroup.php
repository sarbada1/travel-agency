<?php

namespace App\Models\TourPackage;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AttributeGroup extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'name', 'slug', 'description', 'display_order', 'active'
    ];
    
    public function attributes()
    {
        return $this->hasMany(PackageAttribute::class);
    }
}