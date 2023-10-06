<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\GetFilteredFlightRequest;
use App\Http\Requests\StoreFlightRequest;
use App\Http\Requests\UpdateFlightRequest;
use App\Http\Resources\FlightResource;
use App\Http\Services\FlightService;
use App\Models\Flight;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;

class FlightController extends Controller
{
    protected FlightService $flightService;

    public function __construct(FlightService $flightService)
    {
        $this->flightService = $flightService;
    }

    /**
     * @return AnonymousResourceCollection
     * @throws AuthorizationException
     */
    public function flightHistory(): AnonymousResourceCollection
    {
        $this->authorize('viewAny', Flight::class);
        return $this->flightService->flightHistory();
    }

    /**
     * @param GetFilteredFlightRequest $request
     * @return AnonymousResourceCollection
     */
    public function filterFlights(GetFilteredFlightRequest $request): AnonymousResourceCollection
    {
        return $this->flightService->filterFlights($request);
    }

    /**
     * @param StoreFlightRequest $request
     * @return FlightResource
     */
    public function store(StoreFlightRequest $request): FlightResource
    {
        return $this->flightService->store($request);
    }

    /**
     * @param Flight $flight
     * @return FlightResource
     */
    public function show(Flight $flight): FlightResource
    {
        return $this->flightService->show($flight);
    }

    /**
     * @param UpdateFlightRequest $request
     * @param Flight $flight
     * @return FlightResource
     */
    public function update(UpdateFlightRequest $request, Flight $flight): FlightResource
    {
        return $this->flightService->update($request, $flight);
    }

    /**
     * @param Flight $flight
     * @return Response
     * @throws AuthorizationException
     */
    public function destroy(Flight $flight): Response
    {
        $this->authorize('delete', Flight::class);
        $this->flightService->destroy($flight);

        return response()->noContent();
    }
}
