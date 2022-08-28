<?php

namespace App\Http\Controllers;

use App\Models\City;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class CityController extends Controller
{

    public function index()
    {
        return City::with('country')->get();
    }

    public function store(Request $request)
    {
        $data = $request->only('name', 'country_id');
        $validator = Validator::make($data, [
            'name' => 'required|string',
            'country_id' => 'required|exists:countries,id'
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->getMessageBag()], 200);
        }

        $city = City::create($data);

        return $city;
    }

    public function get($id)
    {
        $city = City::with('country')->get()->find($id);

        if (!$city) {
            return response()->json([
                'success' => false,
                'message' => 'Sorry, city not found.',
            ], 403);
        }

        return $city;
    }

    public function update(Request $request, City $city)
    {
        $data = $request->only('name', 'country_id');
        $validator = Validator::make($data, [
            'name' => 'required|string',
            'country_id' => 'required|exists:countries,id'
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->getMessageBag()], 200);
        }

        $city->update($data);

        return $city;
    }

    public function destroy(City $city)
    {
        $city->delete();

        return response()->noContent();
    }

    public function getAirportsByCity($id)
    {
        $city = City::query()->find($id);
        if (!$city) {
            return response()->json([
                'success' => false,
                'message' => 'Sorry, country not found.',
            ], 403);
        }

        return $city->airports;
    }
}
