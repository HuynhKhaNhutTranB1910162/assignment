<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Province extends Model
{
    protected $table = 'provinces';

    protected $fillable = [
        'name',
    ];

    public function districts(): hasMany
    {
        return $this->hasMany(District::class);
    }

    public function addresses(): hasMany
    {
        return $this->hasMany(Address::class);
    }
}
