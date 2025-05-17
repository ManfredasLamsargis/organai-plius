<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Delivery extends Model
{
    use HasFactory;
    protected $fillable = [
        'state'
    ];

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

    public function route()
    {
        return $this->belongsTo(Route::class, 'generated_route_id');
    }

    public function generatedRoute()
    {
        return $this->belongsTo(Route::class, 'generated_route_id');
    }
}
