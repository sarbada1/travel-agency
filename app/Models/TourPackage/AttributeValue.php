<?php

namespace App\Models\TourPackage;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AttributeValue extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'package_attribute_id', 'attributable_id', 'attributable_type',
        'text_value', 'rich_text_value', 'array_value', 'json_value',
        'boolean_value', 'number_value', 'date_value'
    ];
    
    protected $casts = [
        'array_value' => 'array',
        'json_value' => 'array',
        'boolean_value' => 'boolean',
        'date_value' => 'date'
    ];
    
    public function packageAttribute()
    {
        return $this->belongsTo(PackageAttribute::class);
    }
    
    public function attributable()
    {
        return $this->morphTo();
    }
    
    /**
     * Get the appropriate value based on attribute type
     */
    public function getValue()
    {
        $attribute = $this->packageAttribute;
        
        switch ($attribute->type) {
            case 'text':
                return $this->text_value;
            case 'rich_text':
                return $this->rich_text_value;
            case 'array':
                return $this->array_value;
            case 'json':
                return $this->json_value;
            case 'boolean':
                return $this->boolean_value;
            case 'number':
                return $this->number_value;
            case 'date':
                return $this->date_value;
            default:
                return $this->text_value;
        }
    }
}