<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Admin extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens;
    use HasFactory;
    use Notifiable;
    protected $guard = 'admin';

    protected $table = 'admins';

    protected $fillable = [
        'name',
        'email',
        'phone',
        'address',
        'cccd',
        'is_admin',
        'image',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function receipts(): HasMany
    {
        return $this->hasMany(Receipt::class);
    }
    public static function getAdminById(string $id): Model|Collection|Builder|array|null
    {
        return Admin::query()->findOrFail($id);
    }

}
