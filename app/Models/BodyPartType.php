<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\BodyPartOffer;

class BodyPartType extends Model
{
    use HasFactory;

    /**
     * Allows to add items to the database from the application.
     * @var array
     */
    protected $fillable = [
        'name',
        'expiration_period_minutes',
        'description'
    ];

    public function offers()
    {
        return $this->hasMany(BodyPartOffer::class);
    }
}
