<?php

namespace App\Http\Controllers;

use App\Http\Requests\Order\StoreOrderRequest;
use App\Http\Requests\Order\UpdateOrderRequest;
use App\Http\Responses\Response;
use App\Models\Order;
use App\Services\OrderService;
use Illuminate\Http\JsonResponse;
use Throwable;

class OrderController extends Controller
{
    private OrderService $orderService;

    public function __construct(OrderService $orderService)
    {
        $this->orderService = $orderService;
    }

    /**
     * Display a listing of the resource.
     */
    public function buyOrdersList(): JsonResponse
    {
        $data = [];
        try {
            $data = $this->orderService->buyOrdersList();
            return Response::Success($data['data'], $data['message'], $data['code']);
        } catch (Throwable $th) {
            $message = $th->getMessage();
            return Response::Error($data, $message);
        }
    }

    /**
     * Display a listing of the resource.
     */
    public function sellOrdersList(): JsonResponse
    {
        $data = [];
        try {
            $data = $this->orderService->sellOrdersList();
            return Response::Success($data['data'], $data['message'], $data['code']);
        } catch (Throwable $th) {
            $message = $th->getMessage();
            return Response::Error($data, $message);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreOrderRequest $request)
    {
        $data = [];
        try {
            $data = $this->orderService->store($request);
            return Response::Success($data['data'], $data['message'], $data['code']);
        } catch (Throwable $th) {
            $message = $th->getMessage();
            return Response::Error($data, $message);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateOrderRequest $request, Order $order)
    {
        //
    }
}
