<?php

namespace App\Http\Controllers;

use App\Models\Country;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class CountryController extends Controller
{

    public function index()
    {
        return Country::all();
    }

    public function store(Request $request)
    {

        $data = $request->only('name');
        $validator = Validator::make($data, [
            'name' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->getMessageBag()], 200);
        }

        $country = Country::create($data);

        return $country;
    }

    public function get($id)
    {

        $country = Country::query()->find($id);
        if(!$country) {
            return response()->json([
                'success' => false,
                'message' => 'Sorry, country not found.',
            ], 403);
        }

        return $country;
    }

    public function update(Request $request, Country $country)
    {
        $data = $request->only('name');
        $validator = Validator::make($data, [
            'name' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->getMessageBag()], 200);
        }

        $country->update($data);

        return $country;
    }

    public function destroy(Country $country)
    {
        $country->delete();

        return response()->noContent();
    }

    public function getCitiesByCountry($id) {

        $country=Country::query()->find($id);
        if(!$country) {
            return response()->json([
                'success' => false,
                'message' => 'Sorry, country not found.',
            ], 403);
        }

        return $country->cities;
    }
}
