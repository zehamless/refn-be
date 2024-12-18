<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OrderRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'total_amount' => ['required', 'numeric'],
            'status' => ['required'],
            'order_type' => ['required'],
            'order_id' => ['required'],
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
