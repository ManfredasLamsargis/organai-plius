<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CryptoWallet extends Model
{
    use HasFactory;
    public $timestamps = false;
    /**
     * @var array
     */
    protected $fillable = [
        'authorized',
        'address',
        'balance'
    ];
}
