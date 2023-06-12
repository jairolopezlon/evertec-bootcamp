<?php

namespace Src\Orders\Infrastructure\Persistence\Eloquent;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class EloquentOrderEntity extends Model
{
    use HasFactory;

    protected $table = 'orders';

    protected $fillable = [
        'payment_provider',
        'user_id',
        'total',
        'payment_status',
        'currency',
        'payment_id',
        'payment_url',
    ];

    /**
     * @return BelongsTo<User, EloquentOrderEntity>
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @return HasMany<EloquentOrderDetailEntity>
     */
    public function orderDetails(): HasMany
    {
        return $this->hasMany(EloquentOrderDetailEntity::class);
    }
}