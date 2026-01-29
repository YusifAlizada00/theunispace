<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ParkingSpot extends Model
{
    protected $fillable = [
        'street_name',
        'day_from',
        'day_to',
        'time_from',
        'time_to',
        'is_free',
        'description',
        'map_link',
        'distance_meters',
        'driving_distance_meters',
    ];
}
