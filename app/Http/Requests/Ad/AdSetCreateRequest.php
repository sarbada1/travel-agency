<?php

namespace App\Http\Requests\Ad;

use Illuminate\Foundation\Http\FormRequest;

class AdSetCreateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'campaign_id' => 'required|exists:campaigns,id',
            'name' => 'required|string|max:255',
            'status' => 'required|in:active,paused,ended,rejected,review',
            'budget_type' => 'required|in:daily,lifetime',
            'budget_amount' => 'required|numeric|min:0',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'bid_strategy' => 'nullable|in:lowest_cost,target_cost',
            'bid_amount' => 'nullable|numeric|min:0',
            'targeting_specs' => 'nullable|array',
            'description' => 'nullable|string',
        ];
    }

    /**
     * Get custom messages for validator errors.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'campaign_id.required' => 'Please select a campaign',
            'campaign_id.exists' => 'The selected campaign does not exist',
            'name.required' => 'Ad set name is required',
            'status.in' => 'Status must be one of: active, paused, ended, rejected, review',
            'budget_type.in' => 'Budget type must be either daily or lifetime',
            'budget_amount.required' => 'Budget amount is required',
            'budget_amount.numeric' => 'Budget amount must be a number',
            'budget_amount.min' => 'Budget amount must be at least 0',
            'end_date.after_or_equal' => 'End date must be after or equal to start date',
        ];
    }
}