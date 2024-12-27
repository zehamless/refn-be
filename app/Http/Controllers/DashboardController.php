<?php

namespace App\Http\Controllers;

use App\Enums\StatusEnum;
use App\Http\Resources\OrderResource;
use App\Models\Order;
use Illuminate\Http\JsonResponse;

class DashboardController extends Controller
{
    public function index(): JsonResponse
    {
        $orderCounts = Order::query()
            ->selectRaw('status, COUNT(*) as count')
            ->whereIn('status', [
                StatusEnum::UNPAID,
                StatusEnum::PROCESSING,
                StatusEnum::COMPLETED,
                StatusEnum::DECLINED
            ])
            ->groupBy('status')
            ->pluck('count', 'status');

        $data = [
            'unpaid' => $orderCounts[StatusEnum::UNPAID->value] ?? 0,
            'processing' => $orderCounts[StatusEnum::PROCESSING->value] ?? 0,
            'completed' => $orderCounts[StatusEnum::COMPLETED->value] ?? 0,
            'cancelled' => $orderCounts[StatusEnum::DECLINED->value] ?? 0,
        ];

        return response()->json($data);
    }

    public function getRecentOrder()
    {
        $orders = Order::query()
            ->with('user')
            ->whereDate('created_at', today())
            ->orderByDesc('created_at')
            ->get()->toBase();

        return OrderResource::collection($orders);
    }

    public function getProcessingOrder()
    {
        $orders = Order::query()
            ->with('user')
            ->where('status', StatusEnum::PROCESSING)
            ->orderByDesc('updated_at')
            ->get()->toBase();

        return OrderResource::collection($orders);
    }
}
