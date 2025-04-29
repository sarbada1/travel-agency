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
        'name' => 'required|unique:package_attributes,name',
        'slug' => 'required|unique:package_attributes,slug'
        
        ];
    }
}