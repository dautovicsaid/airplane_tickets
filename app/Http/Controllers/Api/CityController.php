<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\StoreCityRequest;
use App\Http\Requests\UpdateCityRequest;
use App\Http\Resources\CityResource;
use App\Http\Services\CityService;
use App\Models\City;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;


class CityController extends Controller
{
    protected CityService $cityService;

    /**
     * @param CityService $cityService
     */
    public function __construct(CityService $cityService)
    {
        $this->cityService = $cityService;
    }

    /**
     * @return AnonymousResourceCollection
     */
    public function index(): AnonymousResourceCollection
    {
        return $this->cityService->index();
    }

    /**
     * @param StoreCityRequest $request
     * @return CityResource
     */
    public function store(StoreCityRequest $request): CityResource
    {
        return $this->cityService->store($request);
    }

    /**
     * @param City $city
     * @return CityResource
     */
    public function show(City $city): CityResource
    {
        return $this->cityService->show($city);
    }

    /**
     * @param UpdateCityRequest $request
     * @param City $city
     * @return CityResource
     */
    public function update(UpdateCityRequest $request, City $city) : CityResource
    {
        return $this->cityService->update($request, $city);
    }

    /**
     * @param City $city
     * @return Response
     * @throws AuthorizationException
     */
    public function destroy(City $city) : Response
    {
        $this->authorize('delete', [City::class, $city]);

        $this->cityService->destroy($city);

        return response()->noContent();
    }

    /**
     * @param City $city
     * @return AnonymousResourceCollection
     */
    public function getAirportsByCity(City $city) : AnonymousResourceCollection
    {
        return $this->cityService->getAirportsByCity($city);
    }
}
