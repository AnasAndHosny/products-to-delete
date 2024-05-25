<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SubCategoryResource extends JsonResource
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
            'category_id' => $this->category_id,
            'category' => $this->category->name
        ];
    }
}
