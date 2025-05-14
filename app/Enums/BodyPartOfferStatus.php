<?php

namespace App\Enums;

enum BodyPartOfferStatus: string
{
    case NOT_ACCEPTED = 'not_accepted';
    case NOT_RESERVED = 'not_reserved';
    case RESERVED = 'reserved';
    case SOLD = 'sold';
}
