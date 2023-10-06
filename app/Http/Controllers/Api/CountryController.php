<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\StoreCountryRequest;
use App\Http\Requests\UpdateCountryRequest;
use App\Http\Resources\CityResource;
use App\Http\Resources\CountryResource;
use App\Http\Services\CountryService;
use App\Models\Country;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;


class CountryController extends Controller
{
    use AuthorizesRequests;

    protected CountryService $countryService;

    /**
     * @param CountryService $countryService
     */
    public function __construct(CountryService $countryService)
    {
        $this->countryService = $countryService;
    }

    /**
     * @return AnonymousResourceCollection
     */
    public function index(): AnonymousResourceCollection
    {
        return $this->countryService->index();
    }

    /**
     * @param StoreCountryRequest $request
     * @return CountryResource
     */
    public function store(StoreCountryRequest $request): CountryResource
    {
        return $this->countryService->store($request);
    }

    /**
     * @param Country $country
     * @return CountryResource
     */
    public function show(Country $country): CountryResource
    {
        return $this->countryService->show($country);
    }

    /**
     * @param UpdateCountryRequest $request
     * @param Country $country
     * @return CountryResource
     */
    public function update(UpdateCountryRequest $request, Country $country): CountryResource
    {
        return $this->countryService->update($request, $country);
    }

    /**
     * @param Country $country
     * @return Response
     * @throws AuthorizationException
     */
    public function destroy(Country $country): Response
    {
        $this->authorize('delete', [Country::class, $country]);

        $this->countryService->destroy($country);

        return response()->noContent();
    }

    /**
     * @param Country $country
     * @return AnonymousResourceCollection
     */
    public function getCitiesByCountry(Country $country): AnonymousResourceCollection
    {
        return CityResource::collection($country->cities);
    }
}
