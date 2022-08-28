<?php

namespace App\Http\Controllers;

use App\Models\Airplane;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AirplaneController extends Controller
{
    public function index()
    {
        return Airplane::all();
    }

    public function store(Request $request)
    {
        $data = $request->only('name', 'economy_seats', 'business_seats', 'first_seats');
        $validator = Validator::make($data, [
            'name' => 'required|string',
            'economy_seats' => 'required|integer',
            'business_seats' => 'required|integer',
            'first_seats' => 'required|integer',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->getMessageBag()], 200);
        }

        $airplane = Airplane::create($data);

        return $airplane;
    }

    public function get($id)
    {
        $airplane = Airplane::query()->find($id);

        if (!$airplane) {
            return response()->json([
                'success' => false,
                'message' => 'Sorry, airplane not found.',
            ], 403);
        }

        return $airplane;
    }

    public function update(Request $request, Airplane $airplane)
    {
        $data = $request->only('name', 'economy_seats', 'business_seats', 'first_seats');
        $validator = Validator::make($data, [
            'name' => 'required|string',
            'economy_seats' => 'required|integer',
            'business_seats' => 'required|integer',
            'first_seats' => 'required|integer',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->getMessageBag()], 200);
        }

        $airplane->update($data);

        return $airplane;
    }

    public function destroy(Airplane $airplane)
    {
        $airplane->delete();

        return response()->noContent();
    }
}
