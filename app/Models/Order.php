<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Enums\OrderStatus;

class Order extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = [
        'created_at',
        'total_price',
        'status'
    ];

    protected $casts = [
        'status' => OrderStatus::class,
        'created_at' => 'datetime'
    ];
}
