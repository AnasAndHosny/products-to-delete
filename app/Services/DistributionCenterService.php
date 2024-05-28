<?php

namespace App\Services;

use App\Http\Resources\DistributionCenterResource;
use App\Models\DistributionCenter;

class DistributionCenterService
{
    public function index(): array
    {
        $distributionCenter = DistributionCenterResource::collection(DistributionCenter::all());
        $message = __('messages.index_success', ['class' => __('distribution centers')]);
        $code = 200;
        return ['distributionCenter' => $distributionCenter, 'message' => $message, 'code' => $code];
    }

    public function store($request): array
    {
        $image = ImageService::store($request);
        $distributionCenter = DistributionCenter::query()->create([
            'image' => $image,
            'name_ar' => $request['name_ar'],
            'name_en' => $request['name_en'],
            'state_id' => $request['state_id'],
            'street_address_ar' => $request['street_address_ar'],
            'street_address_en' => $request['street_address_en'],
            'warehouse_id' => $request['warehouse_id']
        ]);

        $distributionCenter = new DistributionCenterResource($distributionCenter);
        $message = __('messages.store_success', ['class' => __('distribution center')]);
        $code = 201;
        return ['distributionCenter' => $distributionCenter, 'message' => $message, 'code' => $code];
    }

    public function show(DistributionCenter $distributionCenter): array
    {
        $distributionCenter = new DistributionCenterResource($distributionCenter);
        $message = __('messages.show_success', ['class' => __('distribution center')]);
        $code = 200;
        return ['distributionCenter' => $distributionCenter, 'message' => $message, 'code' => $code];
    }

    public function update($request, DistributionCenter $distributionCenter): array
    {
        $image = ImageService::update($request, $distributionCenter);
        $distributionCenter->update([
            'image' => $image,
            'name_ar' => $request['name_ar'] ?? $distributionCenter['name_ar'],
            'name_en' => $request['name_en'] ?? $distributionCenter['name_en'],
            'state_id' => $request['state_id'] ?? $distributionCenter['state_id'],
            'street_address_ar' => $request['street_address_ar'] ?? $distributionCenter['street_address_ar'],
            'street_address_en' => $request['street_address_en'] ?? $distributionCenter['street_address_en'],
            'warehouse_id' => $request['warehouse_id'] ?? $distributionCenter['warehouse_id']
        ]);

        $distributionCenter = new DistributionCenterResource($distributionCenter);
        $message = __('messages.update_success', ['class' => __('distribution center')]);
        $code = 200;
        return ['distributionCenter' => $distributionCenter, 'message' => $message, 'code' => $code];
    }
}
