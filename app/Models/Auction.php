<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Auction extends Model
{
    use HasFactory;

    protected $fillable = [
        'minimal_bid',
        'start_time',
        'finish_time',
        'state',
        'body_part_offer_id',
        'winner_id',
        'participant_count'
    ];
    public function bodyPartOffer()
    {
        return $this->belongsTo(BodyPartOffer::class, 'body_part_offer_id');
    }
}
