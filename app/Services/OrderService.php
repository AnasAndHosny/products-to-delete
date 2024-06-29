<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\OrderResource;
use App\Models\Order;
use App\Models\OrderedProduct;
use App\Models\OrderStatus;

class OrderService
{
    public function buyOrdersList(): array
    {
        $buyOrders = Auth::user()->employee->employable->buyOrders;
        $buyOrders = OrderResource::collection($buyOrders);
        $message = __('messages.index_success', ['class' => __('buy orders')]);
        $code = 200;
        return ['data' => $buyOrders, 'message' => $message, 'code' => $code];
    }

    public function sellOrdersList(): array
    {
        $sellOrders = Auth::user()->employee->employable->sellOrders;
        $sellOrders = OrderResource::collection($sellOrders);
        $message = __('messages.index_success', ['class' => __('sell orders')]);
        $code = 200;
        return ['data' => $sellOrders, 'message' => $message, 'code' => $code];
    }

    public function store($request): array
    {
        $order = DB::transaction(function () use ($request) {
            $employable = Auth::user()->employee->employable;
            $orderedByModel = get_class($employable);
            $orderedById = $employable->id;

            // Calculate the total cost and prepare ordered products
            $totalCost = 0;
            $orderedProducts = [];
            foreach ($request['products'] as $product) {
                $orderedProducts[] = new OrderedProduct([
                    'product_id' => $product['id'],
                    'quantity' => $product['quantity'],
                    'cost' => $product['cost'],
                ]);
                $totalCost += $product['cost'];
            }

            // Create and save the order
            $order = Order::query()->create([
                'orderable_from_type' => $request['orderable_from_type'],
                'orderable_from_id' => $request['orderable_from_id'],
                'orderable_by_type' => $orderedByModel,
                'orderable_by_id' => $orderedById,
                'status_id' => OrderStatus::findByName('Pending')->id,
                'total_cost' => $totalCost,
            ]);

            // Attach ordered products to the order
            $order->orderedProducts()->saveMany($orderedProducts);

            return $order;
        });

        $order = new OrderResource($order);
        $message = __('messages.store_success', ['class' => __('order')]);
        $code = 201;
        return ['data' => $order, 'message' => $message, 'code' => $code];
    }
}
