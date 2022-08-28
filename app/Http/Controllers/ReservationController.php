<?php

namespace App\Http\Controllers;

use App\Models\Flight;
use App\Models\Reservation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Enums\ServerStatus;

class ReservationController extends Controller
{

    public function reservationHistory()
    {
        return Reservation::with(['flight' => ['departmentAirport', 'arrivalAirport', 'airplane'],'user'])->get();
    }


    public function userReservationHistory()
    {
        return Reservation::with(['flight' => ['departmentAirport', 'arrivalAirport', 'airplane']])->where('user_id',auth()->id())->get();
    }


    public function store(Request $request)
    {
        $data = $request->only('flight_id','user_id','class');
        $validator = Validator::make($data, [
            'flight_id' => 'required|exists:flights,id',
            'class' => 'required|in:economy,business,first',
        ]);
        if ($validator->fails()) {
            return response()->json(['error' => $validator->getMessageBag()], 200);
        }
        $data['price'] = Flight::find($data['flight_id'])->getClassPrice($data['class']);
        $data['user_id']= auth()->id();
        $data['is_cancelled'] = false;

        $reservation = Reservation::create($data);

        return $reservation;
    }


    public function cancelReservation($id)
    {

        $reservation = Reservation::find($id);

        if(!$reservation) {
            return response()->json([
                'success' => false,
                'message' => 'Sorry, reservation not found.',
            ], 403);
        }

        if ($reservation->user_id != auth()->id()) {
            return response()->json(['error' => 'Forbidden'], 403);
        }


        if ($reservation->isCancelled()) {
            return response()->json(['error' => 'Reservation is already cancelled'], 400);
        }

        $reservation->is_cancelled = true;
        $reservation->save();

        return $reservation;
    }


}
