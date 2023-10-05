<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateAirplaneRequest extends FormRequest
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
            'name' => 'required|string|min:3|unique:airplanes,name,' . $this->route('airplane')->id,
            'economy_seats' => 'required|integer|gt:0',
            'business_seats' => 'required|integer|gt:0',
            'first_seats' => 'required|integer|gt:0',
        ];
    }
}
