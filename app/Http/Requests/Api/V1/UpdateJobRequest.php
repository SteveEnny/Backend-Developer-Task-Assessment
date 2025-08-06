<?php

namespace App\Http\Requests\Api\V1;

use Illuminate\Foundation\Http\FormRequest;

class UpdateJobRequest extends FormRequest
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
            'title' => ['sometimes', 'string'],
            'company' => ['sometimes', 'string'],
            'company_logo' => ['sometimes','image'],
            'location' => ['sometimes', 'string'],
            'category' => ['sometimes', 'string'],
            'salary' => ['sometimes', 'string'],
            'description' => ['sometimes', 'string'],
            'benefits' => ['sometimes', 'string'],
            'type' => ['sometimes', 'string'],
            'work_condition' => ['sometimes', 'string'],
        ];
    }
}