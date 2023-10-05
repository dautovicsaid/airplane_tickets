<?php

namespace App\Http\Services;

use App\Http\Requests\StoreCountryRequest;
use App\Http\Requests\UpdateCountryRequest;
use App\Http\Resources\CountryResource;
use App\Models\Country;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class CountryService {

    /**
     * @return AnonymousResourceCollection
     */
    public function index() : AnonymousResourceCollection
    {
        return CountryResource::collection(Country::all());
    }

    /**
     * @param StoreCountryRequest $request
     * @return CountryResource
     */
    public function store(StoreCountryRequest $request) : CountryResource
    {
        return new CountryResource(Country::create($request->validated()));
    }

    /**
     * @param Country $country
     * @return CountryResource
     */
    public function show(Country $country) : CountryResource
    {
        return new CountryResource($country);
    }

    /**
     * @param UpdateCountryRequest $request
     * @param Country $country
     * @return CountryResource
     */
    public function update(UpdateCountryRequest $request, Country $country) : CountryResource
    {
        return new CountryResource($country->update($request->validated()));
    }

    /**
     * @param Country $country
     * @return void
     */
    public function destroy(Country $country) : void
    {
        $country->delete();
    }
}
