<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class FlightResource extends JsonResource
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
            'date_from' => $this->date_from,
            'date_to' => $this->date_to,
            'price' => $this->price,
            'boarding_time' => $this->boarding_time,
            'check_in_time' => $this->check_in_time,
            'airplane' => $this->whenLoaded('airplane', function () {
                return new AirplaneResource($this->airplane);
            }),
            'department_airport' => $this->whenLoaded('departmentAirport', function () {
                return new AirportResource($this->departmentAirport);
            }),
            'arrival_airport' => $this->whenLoaded('arrivalAirport', function () {
                return new AirportResource($this->arrivalAirport);
            }),
        ];
    }
}
