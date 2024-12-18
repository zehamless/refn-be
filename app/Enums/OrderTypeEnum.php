<?php

namespace App\Enums;

enum OrderTypeEnum: string
{
    case DELIVER = 'deliver';
    case PICKUP = 'pickup';
}
