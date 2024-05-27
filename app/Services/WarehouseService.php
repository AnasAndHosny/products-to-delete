<?php

namespace App\Services;

use App\Http\Resources\WarehouseResource;
use App\Models\Warehouse;

class WarehouseService
{
    public function index(): array
    {
        $warehouse = WarehouseResource::collection(Warehouse::all());
        $message = __('messages.index_success', ['class' => __('warehouses')]);
        $code = 200;
        return ['warehouse' => $warehouse, 'message' => $message, 'code' => $code];
    }

    public function store($request): array
    {
        $image = ImageService::store($request);
        $warehouse = Warehouse::query()->create([
            'image' => $image,
            'name_ar' => $request['name_ar'],
            'name_en' => $request['name_en'],
            'state_id' => $request['state_id'],
            'street_address_ar' => $request['street_address_ar'],
            'street_address_en' => $request['street_address_en']
        ]);

        $warehouse = new WarehouseResource($warehouse);
        $message = __('messages.store_success', ['class' => __('warehouse')]);
        $code = 201;
        return ['warehouse' => $warehouse, 'message' => $message, 'code' => $code];
    }

    public function show(Warehouse $warehouse): array
    {
        $warehouse = new WarehouseResource($warehouse);
        $message = __('messages.show_success', ['class' => __('warehouse')]);
        $code = 200;
        return ['warehouse' => $warehouse, 'message' => $message, 'code' => $code];
    }

    public function update($request, Warehouse $warehouse): array
    {
        $image = ImageService::update($request, $warehouse);
        $warehouse->update([
            'image' => $image,
            'name_ar' => $request['name_ar'] ?? $warehouse['name_ar'],
            'name_en' => $request['name_en'] ?? $warehouse['name_en'],
            'state_id' => $request['state_id'] ?? $warehouse['state_id'],
            'street_address_ar' => $request['street_address_ar'] ?? $warehouse['street_address_ar'],
            'street_address_en' => $request['street_address_en'] ?? $warehouse['street_address_en']
        ]);

        $warehouse = new WarehouseResource($warehouse);
        $message = __('messages.update_success', ['class' => __('warehouse')]);
        $code = 200;
        return ['warehouse' => $warehouse, 'message' => $message, 'code' => $code];
    }
}
