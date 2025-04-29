<?php

namespace App\Models\Attribute;

use App\Models\AttributeGroup\AttributeGroup;
use App\Models\Category\Category;
use App\Models\Item\ItemAttributeValue;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attribute extends Model
{
    use HasFactory;

    protected $fillable = [
        'attribute_group_id',
        'name',
        'slug',
        'input_type',
        'icon',
        'options'
    ];

    protected $casts = [
        'options' => 'array',

    ];

    public function attributeGroup()
    {
        return $this->belongsTo(AttributeGroup::class);
    }

    public function attribute_group()
    {
        return $this->belongsTo(AttributeGroup::class, 'attribute_group_id');
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'category_attributes', 'attribute_id', 'category_id')
            ->withPivot('is_required', 'display_order');
    }

    public function itemAttributeValues()
    {
        return $this->hasMany(ItemAttributeValue::class);
    }

    /**
     * Get the input type display name
     */
    public function getInputTypeDisplayAttribute()
    {
        $types = [
            'text' => 'Text',
            'number' => 'Number',
            'select' => 'Select Dropdown',
            'checkbox' => 'Multiple Checkboxes',
            'radio' => 'Radio Buttons',
            'textarea' => 'Text Area',
            'file' => 'File Upload',
            'date' => 'Date',
            'color' => 'Color Picker',
            'range' => 'Range Slider',
            'email' => 'Email',
            'tel' => 'Telephone',
            'url' => 'URL'
        ];

        return $types[$this->input_type] ?? $this->input_type;
    }

    /**
     * Get options as string for textarea
     */
    public function getOptionsAsStringAttribute()
    {
        if (is_array($this->options)) {
            return implode("\n", $this->options);
        }

        return '';
    }
}
