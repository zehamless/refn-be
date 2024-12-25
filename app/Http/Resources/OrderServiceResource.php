<?php

namespace App\Http\Resources;

use App\Models\OrderService;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin OrderService */
class OrderServiceResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'price' => $this->price,
            'quantity' => $this->quantity,
            'color' => $this->color,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,

            'order_id' => $this->order_id,

            'order' => new OrderResource($this->whenLoaded('order')),
        ];
    }
}
