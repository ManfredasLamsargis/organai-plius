<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BodyPartOffer extends Model
{
    use HasFactory;

    protected $fillable = ['price', 'received_date', 'description', 'state', 'type_id', 'auction_id', 'order_id', 'provider_id'];

    public function type()
    {
        return $this->belongsTo(BodyPartType::class);
    }
    public function auction()
    {
        return $this->hasOne(Auction::class, 'body_part_offer_id');
    }
    /*public function order()
    {
        return $this->belongsTo(Order::class);
    }
    public function provider()
    {
        return $this->belongsTo(Supplier::class);
    }*/
}
