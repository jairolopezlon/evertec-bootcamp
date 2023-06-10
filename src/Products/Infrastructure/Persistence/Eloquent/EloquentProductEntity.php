<?php

namespace Src\Products\Infrastructure\Persistence\Eloquent;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EloquentProductEntity extends Model
{
    use HasFactory;

    protected $table = 'products';

    protected $fillable = [
        'name',
        'slug',
        'description',
        'price',
        'is_enable',
        'image_url',
    ];

    protected $casts = [
        'is_enable' => 'boolean',
    ];

    public function castAttribute($key, $value)
    {
        if ($key === 'is_enable') {
            return (bool) $value;
        }

        return parent::castAttribute($key, $value);
    }
}
