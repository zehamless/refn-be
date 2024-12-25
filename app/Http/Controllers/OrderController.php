<?php

namespace App\Http\Controllers;

use App\Enums\StatusEnum;
use App\Http\Requests\OrderRequest;
use App\Http\Resources\OrderResource;
use App\Models\Order;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        $validated = $request->validate([
            'perPage' => 'integer|min:1|max:100',
            'sort' => 'string|nullable',
            'filter' => 'string|nullable',
        ]);

        $query = Order::query()->with('user');

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
        try {
            $validated = $request->validated();
            DB::transaction(function () use ($validated) {

                $items = collect($validated['orders']);
                $total = $items->sum(fn($item) => $item['price'] * $item['qty']);

                $status = $validated['paid'] > 0 ? StatusEnum::PROCESSING : StatusEnum::UNPAID;
                $order = Order::create([
                    'notes' => $validated['notes'],
                    'paid' => $validated['paid'],
                    'user_id' => $validated['customer_id'],
                    'order_type' => $validated['delivery_option'],
                    'total_amount' => $total,
                    'status' => $status,
                    'estimated_date' => $validated['estimated_date'],
                ]);
                $order->order_services()->createMany($items->map(function ($item) {
                    return [
                        'name' => $item['name'],
                        'price' => $item['price'],
                        'quantity' => $item['qty'],
                        'color' => $item['color'],
                    ];
                }));
            });

            return response()->json(['message' => 'Order created successfully'], 201);
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'Model not found'], 404);
        } catch (Exception $e) {
            return response()->json(['error' => 'An error occurred while creating the order', $e->getMessage()], 500);
        }
    }

    public function show(Order $order)
    {
        return new OrderResource($order->load('order_services'));
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
