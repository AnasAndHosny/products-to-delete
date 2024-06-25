<?php

namespace App\Models;

use Spatie\Permission\Models\Role as ModelsRole;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Role extends ModelsRole
{
    use HasFactory;

    protected function type(): Attribute
    {
        return Attribute::make(
            get: function ($value) {
                return match ($value) {
                    1 => 'Warehouse',
                    0 => 'DistributionCenter',
                    null  => 'Admin',
                    default => $value
                };
            },
            set: function ($value) {
                return match ($value) {
                    'Warehouse' => true,
                    'DistributionCenter' => false,
                    'Admin'  => null,
                    default => $value
                };
            }
        );
    }

    // Define the scope method
    public function scopeOfTypeName($query, $type)
    {
        // Determine the database value based on the type string
        $value = match ($type) {
            'Warehouse' => 1,
            'DistributionCenter' => 0,
            'Admin' => null,
            default => $type,
        };

        // Apply the query condition
        return $query->where('type', $value);
    }

    public static function ofType($typeName)
    {
        return match ($typeName) {
            'Warehouse' => 1,
            'DistributionCenter' => 0,
            'Admin'  => null,
            default => $typeName
        };
    }
}
