<?php

namespace Src\Orders\Infrastructure\Persistence\Eloquent;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class EloquentOrderDetailEntity extends Model
{
    use HasFactory;

    protected $table = 'order_details';

    protected $fillable = [
        'order_id',
        'product_id',
        'product_name',
        'product_price',
        'quantity',
        'subtotal',
    ];

    /**
     * @return BelongsTo<EloquentOrderEntity, EloquentOrderDetailEntity>
     */
    public function order(): BelongsTo
    {
        return $this->belongsTo(EloquentOrderEntity::class);
    }

    /**
     * Summary of product
     *
     * @return BelongsTo<Product, EloquentOrderDetailEntity>
     */
    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }
}
