<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Receipt extends Model
{
    protected $table = 'receipts';

    protected $fillable = [
        'tracking_number',
        'admin_id',
        'total',
        'status',
        'notes',
    ];

    public function receiptProduct(): HasMany
    {
        return $this->hasMany(ReceiptProduct::class);
    }

    public function admin(): BelongsTo
    {
        return $this->belongsTo(Admin::class);
    }
    public static function getReceiptById(string $id): Model|Collection|Builder|array|null
    {
        return Receipt::query()->findOrFail($id);
    }

}
