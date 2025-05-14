<?php

namespace App\Enums;

enum AuctionStatus: string
{
    case NOT_STARTED = 'not_started';
    case ACTIVE = 'active';
    case WON = 'won';
    case CANCELED = 'canceled';
}
