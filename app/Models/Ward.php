<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ward extends Model
{
    protected $table = 'wards';

    protected $fillable = [
        'name',
        'district_id',
    ];

    public function district()
    {
        return $this->belongsTo(District::class);
    }

    public function addresses(): hasMany
    {
        return $this->hasMany(Address::class);
    }
}
