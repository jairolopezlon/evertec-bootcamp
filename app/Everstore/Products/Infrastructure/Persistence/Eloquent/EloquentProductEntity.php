<?php

namespace App\Everstore\Products\Infrastructure\Persistence\Eloquent;

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
        'is_enabled',
        'image_url',
    ];

    protected $casts = [
        'is_enabled' => 'boolean',
    ];

    public function castAttribute($key, $value)
    {
        if ($key === 'is_enabled') {
            return (bool) $value;
        }

        return parent::castAttribute($key, $value);
    }
}
