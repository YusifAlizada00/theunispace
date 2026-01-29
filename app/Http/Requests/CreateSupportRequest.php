<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateSupportRequest extends FormRequest
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
            'type' => 'required|in:issue,feedback,other',
            'name' => 'required|string',
            'email' => 'required|string',
            'page' => 'nullable|string',
            'solution_steps' => 'nullable|string',
            'feature' => 'nullable|string',
            'suggestions' => 'nullable|string',
            'subject' => 'nullable|string',
            'message' => 'required|string',
        ];
    }
}
