<?php

namespace App\Enums;

enum OrderStatus: string
{
    case UNPAID = 'unpaid';
    case IN_DELIVERY = 'in_delivery';
    case COMPLETED = 'completed';
    case CANCELED = 'canceled';
}
