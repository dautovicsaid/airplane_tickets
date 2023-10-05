<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateCityRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
            return [
                'name' => [
                    'required', 'string', 'max:255',
                    Rule::unique('cities')
                        ->where(function ($query) {
                            return $query->where('country_id', $this->country_id)
                                ->where('name', $this->name)
                                ->where('id', '!=', $this->route('city')->id);
                        })],
                'country_id' => ['required', 'exists:countries,id']
            ];
    }
}
