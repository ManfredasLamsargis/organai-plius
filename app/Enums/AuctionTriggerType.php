<?php

namespace App\Enums;

enum AuctionTriggerType: string
{
    case USER = 'user';
    case TIME = 'time';
    case SKIP = 'skip';
}
