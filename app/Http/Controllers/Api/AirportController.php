<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\StoreAirportRequest;
use App\Http\Requests\UpdateAirportRequest;
use App\Http\Resources\AirportResource;
use App\Http\Services\AirportService;
use App\Models\Airport;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;

class AirportController extends Controller
{
    protected AirportService $airportService;

    /**
     * @param AirportService $airportService
     */
    public function __construct(AirportService $airportService)
    {
        $this->airportService = $airportService;
    }

    /**
     * @return AnonymousResourceCollection
     */
    public function index() : AnonymousResourceCollection
    {
        return $this->airportService->index();
    }

    /**
     * @param StoreAirportRequest $request
     * @return AirportResource
     */
    public function store(StoreAirportRequest $request) : AirportResource
    {
        return $this->airportService->store($request);
    }

    /**
     * @param Airport $airport
     * @return AirportResource
     */
    public function show(Airport $airport) : AirportResource
    {
       return $this->airportService->show($airport);
    }

    /**
     * @param UpdateAirportRequest $request
     * @param Airport $airport
     * @return AirportResource
     */
    public function update(UpdateAirportRequest $request, Airport $airport) : AirportResource
    {
        return $this->airportService->update($request, $airport);
    }

    /**
     * @param Airport $airport
     * @return Response
     * @throws AuthorizationException
     */
    public function destroy(Airport $airport) : Response
    {
        $this->authorize('delete', [Airport::class, $airport]);

        $this->airportService->destroy($airport);

        return response()->noContent();
    }
}
