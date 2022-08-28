<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Airplane extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function flights()
    {
        return $this->hasMany(Flight::class);
    }
}
