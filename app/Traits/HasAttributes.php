<?php

namespace App\Traits;

use App\Models\TourPackage\PackageAttribute;
use App\Models\TourPackage\AttributeValue;

trait HasAttributes
{
    /**
     * Get all attribute values for this model
     */
    public function attributeValues()
    {
        return $this->morphMany(AttributeValue::class, 'attributable');
    }
    
    /**
     * Get a specific attribute value
     */
    public function getAttribute($key)
    {
        // First try to get the attribute from the model itself
        $value = parent::getAttribute($key);
        
        // If it doesn't exist, try to get it from the attribute values
        if ($value === null) {
            $attribute = PackageAttribute::where('slug', $key)->first();
            
            if ($attribute) {
                $attributeValue = $this->attributeValues()
                    ->where('package_attribute_id', $attribute->id)
                    ->first();
                
                return $attributeValue ? $attributeValue->getValue() : null;
            }
        }
        
        return $value;
    }
    
    /**
     * Set an attribute value
     */
    public function setAttribute($key, $value)
    {
        // Check if it's a dynamic attribute
        $attribute = PackageAttribute::where('slug', $key)->first();
        
        if ($attribute) {
            // Get the value type column based on attribute type
            $valueColumn = $this->getValueColumnForType($attribute->type);
            
            // Create or update the attribute value
            AttributeValue::updateOrCreate([
                'package_attribute_id' => $attribute->id,
                'attributable_id' => $this->id,
                'attributable_type' => get_class($this),
            ], [
                $valueColumn => $value
            ]);
            
            return $this;
        }
        
        // Otherwise, set it as a regular attribute
        return parent::setAttribute($key, $value);
    }
    
    /**
     * Get the column name for storing the value based on the attribute type
     */
    protected function getValueColumnForType($type)
    {
        switch ($type) {
            case 'text':
                return 'text_value';
            case 'rich_text':
                return 'rich_text_value';
            case 'array':
                return 'array_value';
            case 'json':
                return 'json_value';
            case 'boolean':
                return 'boolean_value';
            case 'number':
                return 'number_value';
            case 'date':
                return 'date_value';
            default:
                return 'text_value';
        }
    }
}