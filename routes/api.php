<?php

use App\Http\Controllers\Api\AirplaneController;
use App\Http\Controllers\Api\AirportController;
use App\Http\Controllers\Api\CityController;
use App\Http\Controllers\Api\CountryController;
use App\Http\Controllers\Api\FlightController;
use App\Http\Controllers\Api\ReservationController;
use App\Http\Controllers\Auth\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['middleware' => 'api'], function () {

    Route::post('register', [AuthController::class, 'register']);
    Route::post('login', [AuthController::class, 'login']);


    Route::group(['middleware' => 'jwt.verify'], function () {
        Route::get('user', [AuthController::class, 'user']);
        Route::post('logout', [AuthController::class, 'logout']);

        Route::group(['middleware' => 'admin.auth'], function () {

            Route::apiResource('countries', CountryController::class);
            Route::apiResource('cities', CityController::class);
            Route::apiResource('airplanes', AirplaneController::class);
            Route::apiResource('airports', AirportController::class)->except(['index']);

            Route::post('flights', [FlightController::class, 'store']);
            Route::get('flights/history', [FlightController::class, 'flightHistory']);
            Route::get('flights/{flight}', [FlightController::class, 'get']);
            Route::put('flights/{flight}', [FlightController::class, 'update']);

            Route::get('reservations/history', [ReservationController::class, 'reservationHistory']);
        });


        Route::get('airports', [AirportController::class, 'index']);
        Route::get('countries/{country}/cities', [CountryController::class, 'getCitiesByCountry']);
        Route::get('cities/{city}/airports', [CityController::class, 'getAirportsByCity']);
        Route::get('flights', [FlightController::class, 'filterFlights']);


        Route::get('reservations', [ReservationController::class, 'userReservationHistory']);
        Route::patch('reservations/{reservation}/cancel', [ReservationController::class, 'cancelReservation']);
        Route::post('reservations', [ReservationController::class, 'store']);

    });
});
