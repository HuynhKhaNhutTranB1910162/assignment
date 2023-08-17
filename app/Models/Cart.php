<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

class Cart extends Model
{
    use HasFactory;

    protected $fillable = [
        'userId',
        'productId',
        'quantity',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'userId');
    }

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class, 'productId');
    }

    public static function getCartById(string $id): Model|Collection|Builder|array|null
    {
        return Cart::query()->findOrFail($id);
    }
}
