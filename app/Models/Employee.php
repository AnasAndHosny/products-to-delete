<?php

namespace App\Models;

use Carbon\Carbon;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Employee extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'full_name',
        'gender',
        'birthday',
        'phone_number',
        'ssn',
        'state_id',
        'address',
        'user_id',
        'employable_type',
        'employable_id'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'birthday' => 'date:Y-m-d',
    ];

    /**
     * Array of available employable types.
     */
    protected static $availableEmployables = [
        'Warehouse' => Warehouse::class,
        'DistributionCenter' => DistributionCenter::class,
    ];

    /**
     * Accessor for the birthday attribute.
     */
    protected function birthday(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => Carbon::parse($value)->format('Y-m-d'),
        );
    }

    /**
     * Interact with the employee's gender.
     */
    protected function gender(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => $value ? 'male' : 'female',
            set: fn ($value) => $value === 'male'
        );
    }

    /**
     * Accessor for the employable_type attribute.
     */
    protected function employableType(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => array_search($value, self::$availableEmployables) ?: $value,
            set: fn ($value) => self::$availableEmployables[$value] ?? $value
        );
    }

    /**
     * Get the user that owns the employee.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the state that the employee belongs to.
     */
    public function state(): BelongsTo
    {
        return $this->belongsTo(State::class);
    }

    /**
     * Get the parent employable model (warehouse or distribution center).
     */
    public function employable(): MorphTo
    {
        return $this->morphTo();
    }

    /**
     * Scope a query to only include employees whose user role is not 'Admin'.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeNonAdmin($query)
    {
        return $query->whereHas('user.roles', function ($query) {
            $query->where('type', '!=', null);
        });
    }

    /**
     * Accessor for the city attribute based on state.
     */
    public function getCityAttribute($value)
    {
        return $this->state->city;
    }

    /**
     * Static method to return available employable types.
     *
     * @return array
     */
    public static function getAvailableEmployables(): array
    {
        return self::$availableEmployables;
    }
}
