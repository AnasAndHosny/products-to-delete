<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\App;

class State extends Model
{
    use HasFactory;

    protected $fillable = [
        'name_ar',
        'name_en',
        'city_id'
    ];

    // implement the attribute
    public function getNameAttribute($value)
    {
        return $this->{'name_' . App::getlocale()};
    }

    public function city(): BelongsTo
    {
        return $this->belongsTo(City::class);
    }
}
