<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Bid extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'date',
        'amount',
        'auction_id',
    ];

    protected $casts = [
        'date' => 'datetime',
        'amount' => 'float',
    ];

    public function auction()
    {
        return $this->belongsTo(Auction::class);
    }
}
