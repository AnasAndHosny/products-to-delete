<?php

namespace App\Models;

use App\Models\SubCategory;
use Illuminate\Support\Facades\App;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'image',
        'name_ar',
        'name_en',
        'description_ar',
        'description_en',
        'manufacturer',
        'price',
        'subcategory_id'
    ];

    /**
     * Interact with the product's price.
     */
    protected function price(): Attribute
    {
        return Attribute::make(
            get: fn($value) => $value / 100,
            set: fn($value) => $value * 100
        );
    }

    // implement the attributes
    public function getNameAttribute($value)
    {
        return $this->{'name_' . App::getlocale()};
    }

    public function getDescriptionAttribute($value)
    {
        return $this->{'description_' . App::getlocale()};
    }

    public function subCategory(): BelongsTo
    {
        return $this->belongsTo(SubCategory::class, 'subcategory_id', 'id');
    }
}
