<?php

namespace App\Models\TourPackage;

use Illuminate\Database\Eloquent\Model;

class AttributeValue extends Model
{
    protected $fillable = [
        'package_attribute_id',
        'attributable_id',
        'attributable_type',
        'text_value',
        'rich_text_value',
        'numeric_value',
        'boolean_value',
        'json_value',
        'array_value',
        'long_text_value',
        'display_order',
        'item_key'
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
     * Get the value of this attribute based on its type
     */
    public function getValue()
    {
        // Determine which column has the value based on packageAttribute type
        $attribute = $this->packageAttribute;

        if (!$attribute) {
            return null;
        }

        switch ($attribute->type) {
            case 'boolean':
                return (bool) $this->boolean_value;

            case 'number':
                return $this->numeric_value;

            case 'rich_text':
                return $this->rich_text_value ?? $this->text_value ?? $this->long_text_value;

            case 'array':
            case 'json':
                if ($this->json_value) {
                    try {
                        $decoded = json_decode($this->json_value, true);
                        return is_array($decoded) ? $decoded : [$this->json_value];
                    } catch (\Exception $e) {
                        \Log::warning("Error decoding JSON value: " . $e->getMessage());
                        return [$this->json_value];
                    }
                }
                return [];

            default:
                // For text and all other types
                return $this->text_value ?? $this->long_text_value ?? $this->rich_text_value ?? null;
        }
    }
}
