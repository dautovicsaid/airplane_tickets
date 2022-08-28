<?php

// @formatter:off
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App\Models{
/**
 * App\Models\Airplane
 *
 * @property int $id
 * @property string $name
 * @property int $economy_seats
 * @property int $business_seats
 * @property int $first_seats
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Flight[] $flights
 * @property-read int|null $flights_count
 * @method static \Database\Factories\AirplaneFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|Airplane newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Airplane newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Airplane query()
 * @method static \Illuminate\Database\Eloquent\Builder|Airplane whereBusinessSeats($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Airplane whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Airplane whereEconomySeats($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Airplane whereFirstSeats($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Airplane whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Airplane whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Airplane whereUpdatedAt($value)
 */
	class Airplane extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Airport
 *
 * @property int $id
 * @property string $name
 * @property int $city_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\City $city
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Flight[] $flights
 * @property-read int|null $flights_count
 * @method static \Database\Factories\AirportFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|Airport newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Airport newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Airport query()
 * @method static \Illuminate\Database\Eloquent\Builder|Airport whereCityId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Airport whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Airport whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Airport whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Airport whereUpdatedAt($value)
 */
	class Airport extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\City
 *
 * @property int $id
 * @property string $name
 * @property int $country_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Airport[] $airports
 * @property-read int|null $airports_count
 * @property-read \App\Models\Country $country
 * @method static \Database\Factories\CityFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|City newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|City newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|City query()
 * @method static \Illuminate\Database\Eloquent\Builder|City whereCountryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|City whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|City whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|City whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|City whereUpdatedAt($value)
 */
	class City extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Country
 *
 * @property int $id
 * @property string $name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\City[] $cities
 * @property-read int|null $cities_count
 * @method static \Database\Factories\CountryFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|Country newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Country newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Country query()
 * @method static \Illuminate\Database\Eloquent\Builder|Country whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Country whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Country whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Country whereUpdatedAt($value)
 */
	class Country extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Flight
 *
 * @property int $id
 * @property string $date_from
 * @property string $date_to
 * @property string $boarding_time
 * @property string $check_in_time
 * @property int $price
 * @property int $department_airport
 * @property int $arrival_airport
 * @property int $airplane_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Airplane $airplane
 * @property-read \App\Models\Airport $arrivalAirport
 * @property-read \App\Models\Airport $departmentAirport
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Reservation[] $reservations
 * @property-read int|null $reservations_count
 * @method static \Database\Factories\FlightFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|Flight newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Flight newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Flight query()
 * @method static \Illuminate\Database\Eloquent\Builder|Flight whereAirplaneId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Flight whereArrivalAirport($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Flight whereBoardingTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Flight whereCheckInTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Flight whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Flight whereDateFrom($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Flight whereDateTo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Flight whereDepartmentAirport($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Flight whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Flight wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Flight whereUpdatedAt($value)
 */
	class Flight extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Reservation
 *
 * @property int $id
 * @property int $is_cancelled
 * @property int $flight_id
 * @property int $user_id
 * @property string $class
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Flight $flight
 * @property-read \App\Models\User $user
 * @method static \Database\Factories\ReservationFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|Reservation newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Reservation newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Reservation query()
 * @method static \Illuminate\Database\Eloquent\Builder|Reservation whereClass($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Reservation whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Reservation whereFlightId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Reservation whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Reservation whereIsCancelled($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Reservation whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Reservation whereUserId($value)
 */
	class Reservation extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\User
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property \Illuminate\Support\Carbon|null $email_verified_at
 * @property string $password
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read int|null $notifications_count
 * @method static \Database\Factories\UserFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User query()
 * @method static \Illuminate\Database\Eloquent\Builder|User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereUpdatedAt($value)
 */
	class User extends \Eloquent implements \Tymon\JWTAuth\Contracts\JWTSubject {}
}

