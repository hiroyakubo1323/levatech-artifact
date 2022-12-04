<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RecommendationRequest extends FormRequest
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
            'recommendation.timing' => 'required|string|max:100',
            'recommendation.feeling' => 'required|string|max:150',
            'recommendation.point' => 'string|max:300',
            'emotions_array' => 'between:1,3',
        ];
    }
}
