<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAirplaneRequest;
use App\Http\Requests\UpdateAirplaneRequest;
use App\Http\Resources\AirplaneResource;
use App\Http\Services\AirplaneService;
use App\Models\Airplane;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;

class AirplaneController extends Controller
{

    protected AirplaneService $airplaneService;

    /**
     * @param AirplaneService $airplaneService
     */
    public function __construct(AirplaneService $airplaneService)
    {
        $this->airplaneService = $airplaneService;
    }

    /**
     * @return AnonymousResourceCollection
     */
    public function index() : AnonymousResourceCollection
    {
        return $this->airplaneService->index();
    }

    /**
     * @param StoreAirplaneRequest $request
     * @return AirplaneResource
     */
    public function store(StoreAirplaneRequest $request) : AirplaneResource
    {
        return $this->airplaneService->store($request);
    }

    /**
     * @param Airplane $airplane
     * @return AirplaneResource
     */
    public function show(Airplane $airplane) : AirplaneResource
    {
        return $this->airplaneService->show($airplane);
    }

    /**
     * @param UpdateAirplaneRequest $request
     * @param Airplane $airplane
     * @return AirplaneResource
     */
    public function update(UpdateAirplaneRequest $request, Airplane $airplane) : AirplaneResource
    {
        return $this->airplaneService->update($request, $airplane);
    }

    /**
     * @param Airplane $airplane
     * @return Response
     */
    public function destroy(Airplane $airplane) : Response
    {
        $airplane->delete();

        return response()->noContent();
    }
}
