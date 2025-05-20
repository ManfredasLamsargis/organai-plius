<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;

    /**
     * Allows to add items to the database from the application.
     * @var array
     */
    protected $fillable = [
        'date',
        'text'
    ];
}
