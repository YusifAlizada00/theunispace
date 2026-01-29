<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePostRequest extends FormRequest
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
            'image' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif,svg,webp', 'max:20480'], // max 20MB
            'video' => ['nullable', 'mimetypes:video/mp4,video/avi,video/mpeg,video/quicktime', 'max:51200'], // max 50MB
            'description' => 'required|string|max:500',
        ];
    }
}
