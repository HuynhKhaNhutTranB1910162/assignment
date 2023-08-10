<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

class Banner extends Model
{
    protected $table = 'banners';

    protected $fillable = [
        'image',
        'status',
    ];

    public static function getBannerById(string $id): Model|Collection|Builder|array|null
    {
        return Banner::query()->findOrFail($id);
    }
}
