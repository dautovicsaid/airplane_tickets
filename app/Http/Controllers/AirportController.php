<?php

namespace App\Http\Controllers;

use App\Models\Airport;
use App\Http\Requests\StoreAirportRequest;
use App\Http\Requests\UpdateAirportRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AirportController extends Controller
{
    public function index()
    {
        return Airport::with('city')->get();
    }

    public function store(Request $request)
    {
        $data = $request->only('name', 'city_id');
        $validator = Validator::make($data, [
            'name' => 'required|string',
            'city_id' => 'required|exists:cities,id'
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->getMessageBag()], 200);
        }

        $airport = Airport::create($data);

        return $airport;
    }

    public function get($id)
    {
        $airport = Airport::with('city')->get()->find($id);

        if (!$airport) {
            return response()->json([
                'success' => false,
                'message' => 'Sorry, airport not found.',
            ], 403);
        }

        return $airport;
    }

    public function update(Request $request, Airport $airport)
    {
        $data = $request->only('name', 'city_id');
        $validator = Validator::make($data, [
            'name' => 'required|string',
            'city_id' => 'required|exists:cities,id'
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->getMessageBag()], 200);
        }

        $airport->update($data);

        return $airport;
    }

    public function destroy(Airport $airport)
    {
        $airport->delete();

        return response()->noContent();
    }
}
