<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTourRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            "name" => "required|unique:tours,name",
            "city_id" => "required",
            "start_date" => "required",
            "end_date" => "required",
            "package_name" => "nullable",
            "overview" => "nullable",
            "price" => "nullable",
            "sale_price" => "nullable",
            "location" => "nullable",
            "departure" => "nullable",
            "theme" => "nullable",
            "duration" => "nullable",
            "rating" => "nullable",
            "type" => "nullable",
            "style" => "nullable",
            "for_whom" => "nullable",
            "tour_photo" => "nullable|array",
            "tour_photo.*" => "nullable"
        ];
    }
}
