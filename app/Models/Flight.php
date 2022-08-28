<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Flight extends Model
{
    use HasFactory;

    const FIRST_CLASS = 2;
    const ECONOMY_CLASS = 1;
    const BUSINESS_CLASS = 1.5;


    protected $guarded = ['id'];

    public function reservations(){
        return $this->hasMany(Reservation::class);
    }

    public function airplane(){
        return $this->belongsTo(Airplane::class);
    }

    public function departmentAirport(){
        return $this->belongsTo(Airport::class,'department_airport');
    }

    public function arrivalAirport() {
        return $this->belongsTo(Airport::class,'arrival_airport');
    }

    public function getClassPrice($class) {
        if($class == "economy") $price = $this->price * self::ECONOMY_CLASS;
        else if($class == "business") $price = $this->price * self::BUSINESS_CLASS;
        else if($class == "first") $price = $this->price * self::FIRST_CLASS;
        else return null;

        return $price;
    }

}
