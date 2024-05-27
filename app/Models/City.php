<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\App;

class City extends Model
{
    use HasFactory;

    protected $fillable = [
        'name_ar',
        'name_en'
    ];

    // implement the attribute
    public function getNameAttribute($value)
    {
        return $this->{'name_' . App::getlocale()};
    }

    public function states(): HasMany
    {
        return $this->hasMany(State::class);
    }
}
