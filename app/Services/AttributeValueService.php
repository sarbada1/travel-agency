<?php

namespace App\Services;

use App\Models\TourPackage\AttributeValue;
use App\Models\TourPackage\PackageAttribute;

class AttributeValueService
{
    /**
     * Save an attribute value based on its type
     */
    public function saveAttributeValue($tourPackageId, $attributeId, $value, $itemKey = null)
    {
        $attribute = PackageAttribute::findOrFail($attributeId);
        $attributeValue = new AttributeValue();
        $attributeValue->tour_package_id = $tourPackageId;
        $attributeValue->package_attribute_id = $attributeId;
        $attributeValue->item_key = $itemKey;
        
        // Store in the appropriate field based on attribute type
        switch ($attribute->type) {
            case 'text':
                $attributeValue->text_value = $value;
                break;
                
            case 'rich_text':
                $attributeValue->long_text_value = $value;
                break;
                
            case 'number':
                $attributeValue->numeric_value = $value;
                break;
                
            case 'date':
                $attributeValue->date_value = $value;
                break;
                
            case 'boolean':
                $attributeValue->boolean_value = $value ? true : false;
                break;
                
            case 'json':
            case 'array':
                $attributeValue->json_value = is_array($value) ? json_encode($value) : $value;
                break;
                
            default:
                // For backward compatibility
                $attributeValue->value = $value;
        }
        
        $attributeValue->save();
        return $attributeValue;
    }
    
    /**
     * Save itinerary data as a JSON attribute
     */
    public function saveItinerary($tourPackageId, $itineraryData)
    {
        $attribute = PackageAttribute::where('slug', 'itinerary-days')->first();
        
        if (!$attribute) {
            return false;
        }
        
        return $this->saveAttributeValue($tourPackageId, $attribute->id, $itineraryData);
    }
    
    /**
     * Save inclusions as a JSON attribute
     */
    public function saveInclusions($tourPackageId, $inclusions)
    {
        $attribute = PackageAttribute::where('slug', 'inclusions')->first();
        
        if (!$attribute) {
            return false;
        }
        
        return $this->saveAttributeValue($tourPackageId, $attribute->id, $inclusions);
    }
    
    /**
     * Save exclusions as a JSON attribute
     */
    public function saveExclusions($tourPackageId, $exclusions)
    {
        $attribute = PackageAttribute::where('slug', 'exclusions')->first();
        
        if (!$attribute) {
            return false;
        }
        
        return $this->saveAttributeValue($tourPackageId, $attribute->id, $exclusions);
    }
    
    /**
     * Get all attributes for a tour package, grouped by attribute group
     */
    public function getGroupedAttributes($tourPackageId)
    {
        // Get all attribute values for this package
        $values = AttributeValue::where('tour_package_id', $tourPackageId)
                    ->with(['packageAttribute', 'packageAttribute.attributeGroup'])
                    ->get();
                    
        // Group them by attribute group
        $grouped = [];
        foreach ($values as $value) {
            $groupName = $value->packageAttribute->attributeGroup->name ?? 'Other';
            $groupSlug = $value->packageAttribute->attributeGroup->slug ?? 'other';
            
            if (!isset($grouped[$groupSlug])) {
                $grouped[$groupSlug] = [
                    'name' => $groupName,
                    'attributes' => []
                ];
            }
            
            // Use the appropriate value field based on attribute type
            $attributeValue = $this->getTypedValue($value);
            
            $grouped[$groupSlug]['attributes'][] = [
                'id' => $value->packageAttribute->id,
                'name' => $value->packageAttribute->name,
                'slug' => $value->packageAttribute->slug,
                'type' => $value->packageAttribute->type,
                'value' => $attributeValue,
                'item_key' => $value->item_key
            ];
        }
        
        return $grouped;
    }
    
    /**
     * Get the appropriate value based on attribute type
     */
    protected function getTypedValue($attributeValue)
    {
        $type = $attributeValue->packageAttribute->type ?? 'text';
        
        switch ($type) {
            case 'text':
                return $attributeValue->text_value ?? $attributeValue->value;
                
            case 'rich_text':
                return $attributeValue->long_text_value ?? $attributeValue->value;
                
            case 'number':
                return $attributeValue->numeric_value ?? $attributeValue->value;
                
            case 'date':
                return $attributeValue->date_value ?? $attributeValue->value;
                
            case 'boolean':
                return $attributeValue->boolean_value ?? $attributeValue->value;
                
            case 'json':
            case 'array':
                if ($attributeValue->json_value) {
                    return json_decode($attributeValue->json_value, true);
                }
                return $attributeValue->value;
                
            default:
                return $attributeValue->value;
        }
    }
}