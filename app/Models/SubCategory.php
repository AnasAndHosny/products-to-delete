<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\App;

class SubCategory extends Model
{
    use HasFactory;

    protected $fillable = [
        'image',
        'name_ar',
        'name_en',
        'category_id'
    ];

    // implement the attribute
    public function getNameAttribute($value)
    {
        return $this->{'name_' . App::getlocale()};
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }
}
