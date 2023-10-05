<?php

namespace App\Http\Services;

use App\Http\Requests\StoreCityRequest;
use App\Http\Requests\UpdateCityRequest;
use App\Http\Resources\AirportResource;
use App\Http\Resources\CityResource;
use App\Models\City;
use App\Models\Country;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class CityService {

    /**
     * @return AnonymousResourceCollection
     */
    public function index() : AnonymousResourceCollection
    {
        return CityResource::collection(City::with('country')->get());
    }

    /**
     * @param StoreCityRequest $request
     * @return CityResource
     */
    public function store(StoreCityRequest $request) : CityResource
    {
        return new CityResource(City::create($request->validated()));
    }

    /**
     * @param City $city
     * @return CityResource
     */
    public function show(City $city) : CityResource
    {
        return new CityResource($city);
    }

    /**
     * @param UpdateCityRequest $request
     * @param City $city
     * @return CityResource
     */
    public function update(UpdateCityRequest $request, City $city) : CityResource
    {
        return new CityResource($city->update($request->validated()));
    }

    /**
     * @param City $city
     * @return void
     */
    public function destroy(City $city) : void
    {
        $city->delete();
    }

    /**
     * @param City $city
     * @return AnonymousResourceCollection
     */
    public function getAirportsByCity(City $city) : AnonymousResourceCollection
    {
        return AirportResource::collection($city->airports);
    }
}
