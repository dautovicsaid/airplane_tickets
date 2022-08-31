<?php

use App\Http\Controllers\AirplaneController;
use App\Http\Controllers\AirportController;
use App\Http\Controllers\CityController;
use App\Http\Controllers\CountryController;
use App\Http\Controllers\FlightController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\UserAuthController;
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

Route::group(['middleware' => 'api'], function ($router) {

    Route::post('register', [UserAuthController::class, 'register']);
    Route::post('login', [UserAuthController::class, 'login']);



    Route::group(['middleware' => 'jwt.verify'], function ($router) {
        Route::get('user', [UserAuthController::class, 'user']);
        Route::post('logout', [UserAuthController::class, 'logout']);

        //Admin routes

        Route::group(['middleware' => 'admin.auth'], function () {

            // Country routes

            Route::get('countries', [CountryController::class, 'index']);
            Route::post('countries', [CountryController::class, 'store']);
            Route::get('countries/{country}', [CountryController::class, 'get']);
            Route::put('countries/{country}', [CountryController::class, 'update']);
            Route::delete('countries/{country}', [CountryController::class, 'destroy']);

            // City routes

            Route::get('cities', [CityController::class, 'index']);
            Route::post('cities', [CityController::class, 'store']);
            Route::get('cities/{city}', [CityController::class, 'get']);
            Route::put('cities/{city}', [CityController::class, 'update']);
            Route::delete('cities/{city}', [CityController::class, 'destroy']);

            // Airplane routes

            Route::get('airplanes', [AirplaneController::class, 'index']);
            Route::post('airplanes', [AirplaneController::class, 'store']);
            Route::get('airplanes/{airplane}', [AirplaneController::class, 'get']);
            Route::put('airplanes/{airplane}', [AirplaneController::class, 'update']);
            Route::delete('airplanes/{airplane}', [AirplaneController::class, 'destroy']);

            // Airport routes

            Route::get('airports', [AirportController::class, 'index']);
            Route::post('airports', [AirportController::class, 'store']);
            Route::get('airports/{airport}', [AirportController::class, 'get']);
            Route::put('airports/{airport}', [AirportController::class, 'update']);
            Route::delete('airports/{airport}', [AirportController::class, 'destroy']);

            // Flight routes

            Route::post('flights', [FlightController::class, 'store']);
            Route::get('flights/history', [FlightController::class, 'flightHistory']);
            Route::get('flights/{flight}', [FlightController::class, 'get']);
            Route::put('flights/{flight}', [FlightController::class, 'update']);

            // Reservation routes

            Route::get('reservations/history', [ReservationController::class, 'reservationHistory']);


        });

        //Non-admin routes

        Route::get('countries/{country}/cities',[CountryController::class,'getCitiesByCountry']);
        Route::get('cities/{city}/airports', [CityController::class, 'getAirportsByCity']);
        Route::get('flights', [FlightController::class, 'filterFlights']);



        Route::get('reservations', [ReservationController::class, 'userReservationHistory']);
        Route::patch('reservations/{reservation}/cancel', [ReservationController::class, 'cancelReservation']);
        Route::post('reservations', [ReservationController::class, 'store']);

    });
});
