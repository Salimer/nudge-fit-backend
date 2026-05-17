<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreOnboardingData extends FormRequest
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
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'timezone' => ['required', 'string'],
            'locale' => ['required', 'string', 'in:en,ar'],

            'excuses' => ['required', 'array'],
            'excuses.*' => ['required', 'string'],

            'goals' => ['required', 'array'],
            'goals.*' => ['required', 'string'],

            'workout_style' => ['required', 'string'],

            'equipment' => ['required', 'string'],

            'days' => ['required', 'array'],
            'days.*' => ['required', 'string'],

            'target_time' => ['required', 'date_format:H:i'],
        ];
    }
}
