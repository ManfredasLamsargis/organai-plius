<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoadNode extends Model
{
    protected $primaryKey = 'id'; // important, because this is not auto-incrementing
    public $incrementing = false; // OSM ID is your key
    protected $keyType = 'int';

    use HasFactory;
}
