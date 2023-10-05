<?php

namespace App\Http\Services;

use App\Http\Requests\StoreAirplaneRequest;
use App\Http\Requests\UpdateAirplaneRequest;
use App\Http\Resources\AirplaneResource;
use App\Models\Airplane;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class AirplaneService {

    /**
     * @return AnonymousResourceCollection
     */
    public function index() : AnonymousResourceCollection
    {
        return AirplaneResource::collection(Airplane::all());
    }

    /**
     * @param StoreAirplaneRequest $request
     * @return AirplaneResource
     */
    public function store(StoreAirplaneRequest $request) : AirplaneResource
    {
        $airplane = Airplane::create($request->validated());

        return new AirplaneResource($airplane);
    }

    /**
     * @param Airplane $airplane
     * @return AirplaneResource
     */
    public function show(Airplane $airplane) : AirplaneResource
    {
        return new AirplaneResource($airplane);
    }

    public function update(UpdateAirplaneRequest $request, Airplane $airplane) : AirplaneResource
    {
        $airplane->update($request->validated());

        return new AirplaneResource($airplane);
    }


}
