<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Address extends Model
{
    protected $table = 'addresses';

    protected $fillable = [
        'house_number',
        'address',
        'user_id',
        'ward_id',
        'district_id',
        'province_id',
    ];

    public function user(): belongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function ward(): belongsTo
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
}
