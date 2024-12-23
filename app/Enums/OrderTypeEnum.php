<?php

namespace App\Enums;

enum OrderTypeEnum: string
{
    case DELIVER = 'delivery';
    case PICKUP = 'pickup';
}
