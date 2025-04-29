<?php

namespace App\Http\Requests\TourPackage;

use Illuminate\Foundation\Http\FormRequest;

class TourPackageCreateRequest extends FormRequest
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
            'name' => 'required|string|max:255',
            'slug' => 'nullable|unique:tour_packages,slug',
            'short_description' => 'nullable|string',
            'description' => 'nullable|string',
            'duration_days' => 'required|integer|min:1',
            'regular_price' => 'required|numeric|min:0',
            'sale_price' => 'nullable|numeric|min:0',
            'currency' => 'nullable|string|max:10',
            'difficulty_level' => 'nullable|string|max:50',
            'group_size' => 'nullable|integer|min:1',
            'featured_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'gallery_images' => 'nullable|array',
            'gallery_images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'is_featured' => 'nullable|boolean',
            'is_popular' => 'nullable|boolean',
            'status' => 'required|in:active,inactive,draft',
            'categories' => 'required|array',
            'categories.*' => 'exists:categories,id',
            'destinations' => 'required|array',
            'destinations.*' => 'exists:destinations,id',
            'activities' => 'nullable|array',
            'activities.*' => 'exists:activities,id',
            'activity_optional.*' => 'nullable|boolean',
            'activity_cost.*' => 'nullable|numeric|min:0',
        ];
    }
}