<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ReservationResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'is_cancelled' => $this->is_cancelled,
            'class' => $this->class,
            'price' => $this->price,
            'flight' => $this->whenLoaded('flight', new FlightResource($this->flight)),
            'user' => $this->whenLoaded('user', new UserResource($this->user)),
        ];
    }
}
