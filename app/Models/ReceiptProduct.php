<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ReceiptProduct extends Model
{
    protected $table = 'receipt_products';

    protected $fillable = [
        'receipt_id',
        'product_id',
        'stock',
        'price',
    ];

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    public function receipt(): BelongsTo
    {
        return $this->belongsTo(Receipt::class);
    }

    public static function getReceiptProductById(string $id): Model|Collection|Builder|array|null
    {
        return ReceiptProduct::query()->findOrFail($id);
    }
}
