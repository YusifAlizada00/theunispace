<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateparkingSpotRequest extends FormRequest
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
            'street_name' => 'required|string|max:255',
            'day_from' => 'required|string|max:50',
            'day_to' => 'required|string|max:50',
            'time_from' => 'required|date_format:H:i',
            'time_to' => 'required|date_format:H:i',
            'is_free' => 'required|boolean',
            'description' => 'nullable|string',
            'map_link' => 'required|url|max:255',
            'distance_meters' => 'required|numeric|min:0|max:9999.9',
            'driving_distance_meters' => 'required|numeric|min:0|max:9999.9',
        ];
    }
}
