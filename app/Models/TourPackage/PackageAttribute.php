<?php

namespace App\Models\TourPackage;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PackageAttribute extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'name', 
        'slug', 
        'attribute_group_id', 
        'type', 
        'description', 
        'default_value', 
        'display_order',
        'is_required',
        'is_filterable',
        'active',
        'options'
    ];
    
    protected $casts = [
        'is_required' => 'boolean',
        'is_filterable' => 'boolean',
        'active' => 'boolean'
    ];
    
    public function attributeGroup()
    {
        return $this->belongsTo(AttributeGroup::class);
    }
    
    public function attributeValues()
    {
        return $this->hasMany(AttributeValue::class);
    }
}