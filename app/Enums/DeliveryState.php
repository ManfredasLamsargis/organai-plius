<?php

namespace App\Enums;

enum DeliveryState: string
{
    case Unaccepted = 'unaccepted';
    case ReservedForGeneration = 'reserved_for_generation';
    case NotStarted = 'not_started';
    case InProgress = 'in_progress';
    case Cancelled = 'cancelled';
    case Delivered_Unclaimed = 'delivered_unclaimed';
    case Delivered_Claimed = 'delivered_claimed';
}
