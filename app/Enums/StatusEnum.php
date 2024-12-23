<?php

namespace App\Enums;

enum StatusEnum: string
{
    case UNPAID = 'unpaid';
    case PROCESSING = 'processing';
    case COMPLETED = 'completed';
    case DECLINED = 'cancelled';
}
