<?php

namespace App\Http\Resources;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin Order */
class OrderResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'total_amount' => $this->total_amount,
            'status' => $this->status,
            'order_type' => $this->order_type,
            'invoice_id' => $this->invoice_id,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'estimated_date' => $this->estimated_date,
            'user' => new UserResource($this->whenLoaded('user')),
            'order_services' => OrderServiceResource::collection($this->whenLoaded('order_services')),
        ];
    }
}
