<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
        'id' => $this->id,
        'image' => $this->image,
        'name' => $this->name,
        'name_en' => $this->name_en,
        'name_ar' => $this->name_ar,
        'description' => $this->description,
        'description_ar' => $this->disdescription_ar,
        'description_en' => $this->disdescription_en,
        'manufacturer_id' => $this->manufacturer_id,
        'manufacturer' => $this->manufacturer->name,
        'price' => $this->price,
        'subcategory_id' => $this->subcategory_id,
        'subcategory' => $this->subCategory->name
    ];
    }
}
