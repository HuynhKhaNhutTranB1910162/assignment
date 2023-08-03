<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = 'orders';

    protected $fillable = [
        'product_id',
        'user_id',
        'amount',
        'total',
        'quantity',
        'status',
        'notes',
    ];

    public function product(): belongsTo
    {
        return $this->belongsTo(Product::class);
    }

    public function user(): belongsTo
    {
        return $this->belongsTo(User::class);
    }
}
