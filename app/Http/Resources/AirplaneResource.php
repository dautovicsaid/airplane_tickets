<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class AirplaneResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'economy_seats' => $this->economy_seats,
            'business_seats' => $this->business_seats,
            'first_seats' => $this->first_seats,
        ];
    }
}
