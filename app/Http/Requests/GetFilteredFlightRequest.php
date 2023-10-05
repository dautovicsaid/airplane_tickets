<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GetFilteredFlightRequest extends FormRequest
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
            'date_from' => 'required|date|after:today',
            'date_to' => 'required|date|afterorequal:date_from'
        ];
    }
}
