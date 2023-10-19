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
        'shipper_id',
        'shipper_status',
        'user_name',
        'phone',
        'tracking_number',
        'payment',
        'payment_status',
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

    public function shipper(): BelongsTo
    {
        return $this->belongsTo(shipper::class);
    }
    public static function getOrderById(string $id): Model|Collection|Builder|array|null
    {
        return Order::findOrFail($id);
    }
}
