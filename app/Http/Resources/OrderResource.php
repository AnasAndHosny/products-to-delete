<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $orderdProducts = $this->products;
        return [
            'id' => $this->id,
            'orderable_from_type' => $this->orderable_from_type,
            'orderable_from_id' => $this->orderable_from_id,
            'orderable_from' => $this->orderableFrom->name,
            'orderable_by_type' => $this->orderable_by_type,
            'orderable_by_id' => $this->orderable_by_id,
            'orderable_by' => $this->orderableBy->name,
            'status_id' => $this->status_id,
            'status' => $this->status->name,
            'total_cost'=> $this->total_cost,
            'products' => $orderdProducts,
        ];
    }
}
