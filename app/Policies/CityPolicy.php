<?php

namespace App\Policies;

use App\Models\City;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class CityPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can delete the model.
     *
     * @param \App\Models\User $user
     * @param \App\Models\City $city
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, City $city)
    {
        return $city->airports()->count() === 0;
    }
}
