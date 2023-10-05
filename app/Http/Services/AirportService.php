<?php

namespace App\Http\Services;

use App\Http\Requests\StoreAirportRequest;
use App\Http\Requests\UpdateAirportRequest;
use App\Http\Resources\AirportResource;
use App\Http\Resources\CityResource;
use App\Models\Airport;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class AirportService {

    /**
     * @return AnonymousResourceCollection
     */
    public function index() : AnonymousResourceCollection
    {
        return AirportResource::collection(Airport::with('city')->get());
    }

    /**
     * @param StoreAirportRequest $request
     * @return AirportResource
     */
    public function store(StoreAirportRequest $request) : AirportResource
    {
        return new AirportResource(Airport::create($request->validated()));
    }

    /**
     * @param Airport $airport
     * @return AirportResource
     */
    public function show(Airport $airport) : AirportResource
    {
        return new AirportResource($airport);
    }

    /**
     * @param UpdateAirportRequest $request
     * @param Airport $airport
     * @return AirportResource
     */
    public function update(UpdateAirportRequest $request, Airport $airport) : AirportResource
    {
        return new AirportResource($airport->update($request->validated()));
    }

    /**
     * @param Airport $airport
     * @return void
     */
    public function destroy(Airport $airport) : void
    {
        $airport->delete();
    }
}
