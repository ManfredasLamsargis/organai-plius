<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Enums\BodyPartOfferStatus;

class BodyPartOffer extends Model
{
    use HasFactory;
    public $timestamps = false;

    protected $fillable = [
        'price',
        'available_at',
        'description',
        'status',
        'last_updated_at',
        'body_part_type_id'
    ];

    protected $casts = [
        'status' => BodyPartOfferStatus::class
    ];

    public function bodyPartType()
    {
        return $this->belongsTo(BodyPartType::class);
    }

    public function auction()
    {
        return $this->hasOne(Auction::class);
    }
}
