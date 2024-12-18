<?php

namespace App\Enums;

enum StatusEnum: string
{
    case NOT_PAID = 'not_paid';
    case PROCESSING = 'processing';
    case COMPLETED = 'completed';
    case DECLINED = 'cancelled';
}
