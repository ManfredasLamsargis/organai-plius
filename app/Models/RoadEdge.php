<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoadEdge extends Model
{
    use HasFactory;

    public function from()
    {
        return $this->belongsTo(RoadNode::class, 'from_id');
    }

    public function to()
    {
        return $this->belongsTo(RoadNode::class, 'to_id');
    }
}
