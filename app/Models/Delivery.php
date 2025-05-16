<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Delivery extends Model
{
    use HasFactory;

    protected $fillable = ['state', 'carried_order_id', 'responsible_courier_id', 'pickup_point_id', 'drop_point_id', 'generated_route_id', 'current_location_id'];

    /*public function carriedOrder()
    {
        return $this->belongsTo(Order::class, 'carried_order_id');
    }
    public function responsibleCourier()
    {
        return $this->belongsTo(Courier::class, 'responsible_courier_id');
    }
    public function pickupPoint()
    {
        return $this->belongsTo(Coordinate::class, 'pickup_point_id');
    }
    public function dropPoint()
    {
        return $this->belongsTo(Coordinate::class, 'drop_point_id');
    }
    public function generatedRoute()
    {
        return $this->belongsTo(Route::class, 'generated_route_id');
    }
    public function currentLocation()
    {
        return $this->belongsTo(Coordinate::class, 'current_location_id');
    }*/
}
