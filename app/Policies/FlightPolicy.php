<?php

namespace App\Policies;

use App\Models\Flight;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class FlightPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can delete the model.
     *
     * @param \App\Models\User $user
     * @param \App\Models\Flight $flight
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, Flight $flight)
    {
       return $flight->reservations()->count() === 0;
    }
}
