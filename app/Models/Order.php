<?php

namespace App\Models;

use App\Enums\OrderTypeEnum;
use App\Enums\StatusEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'total_amount',
        'status',
        'order_type',
        'order_id',
        'notes',
    ];

    protected function casts(): array
    {
        return [
            'status' => StatusEnum::class,
            'order_type' => OrderTypeEnum::class,
        ];
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
