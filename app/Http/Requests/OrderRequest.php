<?php

namespace App\Http\Requests;

use App\Enums\OrderTypeEnum;
use App\Enums\StatusEnum;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Enum;

class OrderRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'orders' => 'sometimes|array',
            'orders.*.id' => 'sometimes|integer',
            'orders.*.name' => 'sometimes|string',
            'orders.*.color' => 'string',
            'orders.*.price' => 'sometimes|numeric',
            'orders.*.qty' => 'sometimes|integer',
            'notes' => 'nullable|string',
            'paid' => 'sometimes|numeric',
            'customer_id' => 'sometimes|exists:users,id',
            'delivery_option' => ['sometimes', 'string', new Enum(OrderTypeEnum::class)],
            'estimated_date' => 'sometimes|date',
            'status' => ['sometimes', 'string', new Enum(StatusEnum::class)],
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
