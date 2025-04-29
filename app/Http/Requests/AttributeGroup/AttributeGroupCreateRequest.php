<?php

namespace App\Http\Requests\AttributeGroup;

use Illuminate\Foundation\Http\FormRequest;

class AttributeGroupCreateRequest extends FormRequest
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
            'description' => 'nullable|string',
            'display_order' => 'nullable|integer',
            'active' => 'nullable|boolean',
        ];
    }
}