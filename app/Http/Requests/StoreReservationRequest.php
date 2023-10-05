<?php

namespace App\Http\Requests;

use App\Models\Flight;
use Illuminate\Foundation\Http\FormRequest;

class StoreReservationRequest extends FormRequest
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
            'flight_id' => 'required|exists:flights,id',
            'class' => 'required|in:economy,business,first',
        ];
    }

    public function validated($key = null, $default = null)
    {
        $data = parent::validated($key, $default);

        $data['price'] = Flight::find($this->flight_id)->getClassPrice($this->class);
        $data['user_id'] = auth()->id();
        $data["is_cancelled"] = false;

        return $data;
    }
}
