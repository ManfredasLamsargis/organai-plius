<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
    use HasFactory;

    // Takes these fields from the associated array.
    protected $fillable = ['note', 'user_id'];
}
