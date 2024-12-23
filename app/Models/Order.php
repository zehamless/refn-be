<?php

namespace App\Models;

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
        'notes',
        'paid',
        'user_id',
    ];

    protected static function boot()
    {
        parent::boot();
        self::creating(function ($model) {
            $model->invoice_id = uuid_create(); // Ensure there's an invoice_id column in the orders table
        });
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function order_services()
    {
        return $this->hasMany(OrderService::class);
    }

}
