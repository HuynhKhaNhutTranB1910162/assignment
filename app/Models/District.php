<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class District extends Model
{
    protected $table = 'districts';

    protected $fillable = [
        'name',
        'province_id',
    ];

    public function province(): belongsTo
    {
        return $this->belongsTo(Province::class);
    }

    public function wards(): hasMany
    {
        return $this->hasMany(Ward::class);
    }

    public function addresses(): hasMany
    {
        return $this->hasMany(Address::class);
    }
}
