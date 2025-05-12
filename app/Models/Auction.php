<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Enums\AuctionStatus;

class Auction extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'minimum_bid',
        'start_time',
        'end_time',
        'status',
        'participant_count'
    ];

    protected $casts = [
        'start_time' => 'datetime',
        'end_time' => 'datetime',
        'status' => AuctionStatus::class
    ];

    public function bodyPartOffer()
    {
        return $this->belongsTo(BodyPartOffer::class);
    }
}
