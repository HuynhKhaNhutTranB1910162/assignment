<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens;
    use HasFactory;
    use Notifiable;

    protected $fillable = [
        'name',
        'email',
        'phone',
        'password',
        'image',
        'provider_id',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function productReview(): HasMany
    {
        return $this->hasMany(ProductReview::class);
    }
    public function orders(): hasMany
    {
        return $this->hasMany(Order::class);
    }
    public function addresses(): hasMany
    {
        return $this->hasMany(Address::class);
    }
    public function carts(): HasMany
    {
        return $this->hasMany(Cart::class, 'userId');
    }
    public static function getUserById(string $id): Model|Collection|Builder|array|null
    {
        return User::query()->findOrFail($id);
    }
}
