<?php

namespace App\Http\Controllers;

use App\Models\Flight;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class FlightController extends Controller
{


    public function flightHistory() {

        return Flight::with('departmentAirport', 'arrivalAirport', 'airplane')->get();

    }

    public function filterFlights(Request $request)
    {
        $data = $request->only('department_airport','arrival_airport','airplane_id','boarding_time', 'check_in_time', 'date_from', 'date_to', 'price');
        $validator = Validator::make($data, [
            'department_airport' => 'required|exists:airports,id',
            'arrival_airport' => 'required|exists:airports,id|different:department_airport',
            'date_from' => 'required|date|after:today',
            'date_to' => 'required|date|afterorequal:date_from'
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->getMessageBag()], 200);
        }

        $flights = Flight::with('departmentAirport', 'arrivalAirport', 'airplane')
            ->where('department_airport',$data['department_airport'])
            ->where('arrival_airport',$data['arrival_airport'])
            ->whereBetween('date_from',[$data['date_from'],$data['date_to']])
            ->whereBetween('date_to',[$data['date_from'],$data['date_to']])
            ->get();

        return $flights;
        // Kako pristupiti $data podacima da bi ih dobio u where-u


    }

    public function store(Request $request)
    {
        $data = $request->only('department_airport','arrival_airport','airplane_id','boarding_time', 'check_in_time', 'date_from', 'date_to', 'price');
        $validator = Validator::make($data, [
            'department_airport' => 'required|exists:airports,id',
            'arrival_airport' => 'required|exists:airports,id|different:department_airport',
            'airplane_id' => 'required|exists:airplanes,id',
            'date_from' => 'required|date|after:today',
            'date_to' => 'required|date|after:date_from',
            'check_in_time' => 'required|date|after:today',
            'boarding_time' =>'required|date|after:check_in_time',
            'price' => 'required|numeric',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->getMessageBag()], 200);
        }

        $flight = Flight::create($data);

        return $flight;
    }



    public function get($id)
    {
        $flight = Flight::with('departmentAirport', 'arrivalAirport', 'airplane')->get()->find($id);
        if(!$flight) {
            return response()->json([
                'success' => false,
                'message' => 'Sorry, flight not found.',
            ], 403);
        }

        return $flight;
    }

    public function update(Request $request, Flight $flight)
    {
        $data = $request->only('department_airport','arrival_airport','airplane_id','boarding_time', 'check_in_time', 'date_from', 'date_to', 'price');
        $validator = Validator::make($data, [
            'department_airport' => 'required|exists:airports,id',
            'arrival_airport' => 'required|exists:airports,id|different:department_airport',
            'airplane_id' => 'required|exists:airplanes,id',
            'date_from' => 'required|date|after:today',
            'date_to' => 'required|date|after:date_from',
            'check_in_time' => 'required|date|after:today',
            'boarding_time' =>'required|date|after:check_in_time',
            'price' => 'required|numeric',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->getMessageBag()], 200);
        }

        $flight->update($data);

        return $flight;
    }


    public function destroy(Flight $flight)
    {
        $flight->delete();

        return response()->noContent();
    }
}
