<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContactLostReportRequest extends FormRequest
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
            'item_name' => 'required|string|max:255',
            'detailed_description' => 'required|string',
            'date_found' => 'required|date',
            'location_found' => 'required|string',
            'images_found' => 'nullable|array',
            'images_found.*' => 'image|mimes:jpeg,png,jpg,gif,svg,webp|max:20480', // max 20MB per image
        ];
    }
}
