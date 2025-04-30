<?php

namespace App\Models\TourPackage;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AttributeValue extends Model
{
    use HasFactory;

    protected $fillable = [
        'package_attribute_id',
        'attributable_id',
        'attributable_type',
        'text_value',
        'rich_text_value',
        'long_text_value',
        'numeric_value',
        'date_value',
        'boolean_value',
        'json_value',
        'array_value',
        'item_key',
        'display_order'
    ];

    protected $casts = [
        'boolean_value' => 'boolean',
        'numeric_value' => 'float',
        'date_value' => 'date'
    ];

    /**
     * Get the package attribute that owns the value.
     */
    public function packageAttribute()
    {
        return $this->belongsTo(PackageAttribute::class, 'package_attribute_id');
    }

    /**
     * Get the owner model of the attribute value.
     */
    public function attributable()
    {
        return $this->morphTo();
    }

    /**
     * Get the appropriate value based on attribute type
     */
    public function getValue()
    {
        $type = $this->packageAttribute->type ?? 'text';
        
        switch ($type) {
            case 'text':
                return $this->text_value;
                
            case 'rich_text':
                return $this->rich_text_value;
                
            case 'long_text':
                return $this->long_text_value;
                
            case 'number':
                return $this->numeric_value;
                
            case 'date':
                return $this->date_value;
                
            case 'boolean':
                return $this->boolean_value;
                
            case 'json':
            case 'array':
                if ($this->json_value) {
                    return json_decode($this->json_value, true);
                } elseif ($this->array_value) {
                    return json_decode($this->array_value, true);
                }
                return null;
                
            default:
                return $this->text_value;
        }
    }
}