<?php

namespace App\Everstore\Orders\Infrastructure\Persistence\Eloquent;

use App\Models\Product;
use Database\Factories\EloquentOrderDetailEntityFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class EloquentOrderDetailEntity extends Model
{
    use HasFactory;

    protected static function newFactory(): EloquentOrderDetailEntityFactory
    {
        return new EloquentOrderDetailEntityFactory();
    }

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
