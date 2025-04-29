<?php

namespace App\Http\Requests\Ad;

use Illuminate\Foundation\Http\FormRequest;

class AdPlacementCreateRequest extends FormRequest
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
     */
    public function rules(): array
    {
        return [
            'ad_id' => 'required|exists:ads,id',
            'position_id' => 'required|exists:ad_positions,id',
            'priority' => 'required|integer|min:1',
        ];
    }
}