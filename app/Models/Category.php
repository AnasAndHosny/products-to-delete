<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\App;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'name_ar',
        'name_en'
    ];

    // Accessor for the localized name attribute
    public function getNameAttribute($value)
    {
        return $this->{'name_' . App::getlocale()};
    }

    public function subCategories(): HasMany
    {
        return $this->hasMany(SubCategory::class);
    }
}
