<?php

namespace App\Models;

use App\Enums\User\Role;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    public const DEFAULT_CALORIE_LIMIT = 2100;

    public const MONTHLY_MONEY_LIMIT = 1000;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'role' => Role::class,
    ];

    /**
     * @return string
     */
    public function getCaloriesForTodayCacheKey(): string
    {
        return 'user-'. $this->id . '-calories';
    }

    /**
     * @return string
     */
    public function getMoneySpentCacheKey(): string
    {
        return 'user-'. $this->id . '-money';
    }

    /**
     * @return HasMany
     */
    public function foodEntries(): HasMany
    {
        return $this->hasMany(FoodEntry::class);
    }
}
