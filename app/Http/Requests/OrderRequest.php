<?php

namespace App\Http\Requests;

use App\Enums\OrderTypeEnum;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Enum;

class OrderRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'orders' => 'required|array',
            'orders.*.id' => 'required|integer',
            'orders.*.name' => 'required|string',
            'orders.*.color' => 'string',
            'orders.*.price' => 'required|numeric',
            'orders.*.qty' => 'required|integer',
            'notes' => 'nullable|string',
            'paid' => 'required|numeric',
            'customer_id' => 'required|exists:users,id',
            'delivery_option' => ['required', 'string', new Enum(OrderTypeEnum::class)],
            'estimated_date' => 'required|date',
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
