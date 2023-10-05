<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreFlightRequest extends FormRequest
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
            'department_airport' => 'required|exists:airports,id',
            'arrival_airport' => 'required|exists:airports,id|different:department_airport',
            'airplane_id' => 'required|exists:airplanes,id',
            'date_from' => 'required|date|after:today',
            'date_to' => 'required|date|after:date_from',
            'check_in_time' => 'required|date|after:today',
            'boarding_time' =>'required|date|after:check_in_time',
            'price' => 'required|numeric|gt:0',
        ];
    }
}
