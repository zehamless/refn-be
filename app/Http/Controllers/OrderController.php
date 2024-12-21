<?php

namespace App\Http\Controllers;

use App\Http\Requests\OrderRequest;
use App\Http\Resources\OrderResource;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        $validated = $request->validate([
            'perPage' => 'integer|min:1|max:100',
            'sort' => 'string|nullable',
            'filter' => 'string|nullable',
        ]);

        $query = Order::query();

        if (!empty($validated['sort'])) {
            $sortFields = explode(',', $validated['sort']);
            for ($i = 0; $i < count($sortFields); $i += 2) {
                $query->orderBy($sortFields[$i], $sortFields[$i + 1] ?? 'asc');
            }
        }

        if (!empty($validated['filter'])) {
            $filterFields = explode(',', $validated['filter']);
            $query->whereStatus(last($filterFields));
        }

        $orders = $query->paginate($validated['perPage']);
        return OrderResource::collection($orders);
    }

    public function store(OrderRequest $request)
    {
        return new OrderResource(Order::create($request->validated()));
    }

    public function show(Order $order)
    {
        return new OrderResource($order);
    }

    public function update(OrderRequest $request, Order $order)
    {
        $order->update($request->validated());

        return new OrderResource($order);
    }

    public function destroy(Order $order)
    {
        $order->delete();

        return response()->json();
    }
}
