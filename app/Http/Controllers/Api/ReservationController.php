<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\StoreReservationRequest;
use App\Http\Resources\ReservationResource;
use App\Http\Services\ReservationService;
use App\Models\Reservation;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class ReservationController extends Controller
{
    protected ReservationService $reservationService;

    public function __construct(ReservationService $reservationService)
    {
        $this->reservationService = $reservationService;
    }

    /**
     * @return AnonymousResourceCollection
     */
    public function reservationHistory(): AnonymousResourceCollection
    {
        return $this->reservationService->reservationHistory();
    }


    /**
     * @return AnonymousResourceCollection
     */
    public function userReservationHistory() : AnonymousResourceCollection
    {
        return $this->reservationService->userReservationHistory();
    }


    /**
     * @param StoreReservationRequest $request
     * @return ReservationResource
     */
    public function store(StoreReservationRequest $request) : ReservationResource
    {
       return $this->reservationService->store($request);
    }


    /**
     * @param Reservation $reservation
     * @return ReservationResource
     * @throws AuthorizationException
     */
    public function cancelReservation(Reservation $reservation) : ReservationResource
    {
        $this->authorize('cancel', $reservation);

        return $this->reservationService->cancelReservation($reservation);
    }


}
