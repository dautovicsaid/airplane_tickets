<?php

namespace App\Http\Services;

use App\Http\Requests\StoreReservationRequest;
use App\Http\Resources\ReservationResource;
use App\Models\Reservation;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class ReservationService
{
    /**
     * @return AnonymousResourceCollection
     */
    public function reservationHistory(): AnonymousResourceCollection
    {
        return ReservationResource::collection(
            $this->getReservationsQuery()->get()
        );
    }

    /**
     * @return AnonymousResourceCollection
     */
    public function userReservationHistory(): AnonymousResourceCollection
    {
        return ReservationResource::collection(
            $this->getReservationsQuery(false)
                ->where('user_id', auth()->id())
                ->get()
        );
    }

    /**
     * @param bool $includeUser
     * @return Builder
     */
    private function getReservationsQuery(bool $includeUser = true): Builder
    {
        $query = Reservation::with(
            ['flight.departmentAirport:id,name', 'flight.arrivalAirport:id,name', 'flight.airplane:id,name']);

        if ($includeUser) $query->with('user:name');

        return $query;
    }

    /**
     * @param StoreReservationRequest $request
     * @return ReservationResource
     */
    public function store(StoreReservationRequest $request): ReservationResource
    {
        $reservation = Reservation::create($request->validated());

        return ReservationResource::make($reservation
            ->load(['flight.departmentAirport:id,name', 'flight.arrivalAirport:id,name', 'flight.airplane:id,name']));
    }

    /**
     * @param Reservation $reservation
     * @return ReservationResource
     */
    public function cancelReservation(Reservation $reservation): ReservationResource
    {
        $reservation->update([
            'is_cancelled' => true
        ]);

        return ReservationResource::make($reservation
            ->load(['flight.departmentAirport:id,name', 'flight.arrivalAirport:id,name', 'flight.airplane:id,name']));
    }

}
