<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Delivery extends Model
{
    use HasFactory;

    public function pickupPoint()
    {
        return $this->belongsTo(Coordinate::class, 'pickup_point_coordinate_id');
    }

    public function dropPoint()
    {
        return $this->belongsTo(Coordinate::class, 'drop_point_coordinate_id');
    }

    public function currentLocation()
    {
        return $this->belongsTo(Coordinate::class, 'current_location_coordinate_id');
    }
}
