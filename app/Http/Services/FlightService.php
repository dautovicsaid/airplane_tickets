<?php

namespace App\Http\Services;

use App\Http\Requests\GetFilteredFlightRequest;
use App\Http\Requests\StoreFlightRequest;
use App\Http\Requests\UpdateFlightRequest;
use App\Http\Resources\FlightResource;
use App\Models\Flight;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class FlightService
{

    /**
     * @return AnonymousResourceCollection
     */
    public function flightHistory() : AnonymousResourceCollection
    {
        return FlightResource::collection(Flight::with('departmentAirport', 'arrivalAirport', 'airplane')->get());
    }

    /**
     * @param GetFilteredFlightRequest $request
     * @return AnonymousResourceCollection
     */
    public function filterFlights(GetFilteredFlightRequest $request): AnonymousResourceCollection
    {
        $dateFrom = $request->get('date_from');
        $dateTo = $request->get('date_to');

        return FlightResource::collection(
            Flight::with('departmentAirport', 'arrivalAirport', 'airplane')
                ->where('department_airport', $request->get('department_airport'))
                ->where('arrival_airport', $request->get('arrival_airport'))
                ->whereBetween('date_from', [$dateFrom, $dateTo])
                ->whereBetween('date_to', [$dateFrom, $dateTo])
                ->get());
    }

    /**
     * @param StoreFlightRequest $request
     * @return FlightResource
     */
    public function store(StoreFlightRequest $request): FlightResource
    {
        return FlightResource::make(
            Flight::create($request->validated())
                ->load('departmentAirport', 'arrivalAirport', 'airplane'));
    }

    /**
     * @param Flight $flight
     * @return FlightResource
     */
    public function show(Flight $flight): FlightResource
    {
        return FlightResource::make($flight->load('departmentAirport', 'arrivalAirport', 'airplane'));
    }

    /**
     * @param UpdateFlightRequest $request
     * @param Flight $flight
     * @return FlightResource
     */
    public function update(UpdateFlightRequest $request, Flight $flight)
    {
        $flight->update($request->validated());
        return FlightResource::make($flight->load('departmentAirport', 'arrivalAirport', 'airplane'));
    }

    /**
     * @param Flight $flight
     * @return void
     */
    public function destroy(Flight $flight) : void
    {
        $flight->delete();
    }


}
