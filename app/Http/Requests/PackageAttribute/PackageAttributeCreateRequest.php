<?php

namespace App\Http\Requests\PackageAttribute;

use Illuminate\Foundation\Http\FormRequest;

class PackageAttributeCreateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required',
            'slug' => 'required',
            'attribute_group_id' => 'required|exists:attribute_groups,id',
            'type' => 'required|in:text,rich_text,array,json,boolean,number,date',
            'description' => 'nullable|string',
            'is_required' => 'nullable|boolean',
            'is_filterable' => 'nullable|boolean',
            'active' => 'nullable|boolean',
            'display_order' => 'nullable|integer',
            'options' => 'nullable|array',
            'default_value' => 'nullable|string',
        ];
    }
}