<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'image',
        'name_ar',
        'name_en'
    ];

    /**
     * add name attribute that retrieve the name in local app language
     */

    // Make the attribute available in the json response
    protected $appends = [
        'name'
    ];

    // implement the attribute
    public function getNameAttribute($value)
    {
        return $this->{'name_' . App::getlocale()};
    }
}
