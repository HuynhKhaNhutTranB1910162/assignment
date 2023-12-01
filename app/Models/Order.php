<?php

namespace App\Models;

use Carbon\Carbon;
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
        'reviews',
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

    public static function getMonthlyRevenue()
    {
        $startOfMonth = Carbon::now()->startOfMonth();
        $endOfMonth = Carbon::now()->endOfMonth();

        return static::whereBetween('updated_at', [$startOfMonth, $endOfMonth])
            ->where('status', 'success')
            ->sum('total');
    }
}
