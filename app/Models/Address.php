<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

class Address extends Model
{
    protected $table = 'addresses';

    protected $fillable = [
        'user_name',
        'address',
        'user_id',
        'ward_id',
        'district_id',
        'province_id',
        'phone_number',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function ward(): BelongsTo
    {
        return $this->belongsTo(Ward::class);
    }

    public function district(): belongsTo
    {
        return $this->belongsTo(District::class);
    }

    public function province(): belongsTo
    {
        return $this->belongsTo(Province::class);
    }

    public static function getAddressByUserId(string $id): Model|Collection|Builder|array|null
    {
        return Address::findOrFail($id);
    }
}
