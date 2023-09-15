<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

class Order extends Model
{
    protected $table = 'orders';

    protected $fillable = [
        'shipping_address',
        'user_id',
        'user_name',
        'phone',
        'tracking_number',
        'payment',
        'total',
        'status',
        'notes',
    ];

    public function orderProduct(): HasMany
    {
        return $this->hasMany(OrderProduct::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
    public static function getOrderById(string $id): Model|Collection|Builder|array|null
    {
        return Order::findOrFail($id);
    }
}
