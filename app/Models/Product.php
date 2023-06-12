<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'description',
        'price',
        'is_enabled',
        'has_availability',
        'image_url',
        'stock',
    ];

    protected $casts = [
        'is_enabled' => 'boolean',
        'has_availability' => 'boolean',
    ];

    public function castAttribute($key, $value)
    {
        if ($key === 'is_enabled') {
            return (bool) $value;
        }
        if ($key === 'has_availability') {
            return (bool) $value;
        }

        return parent::castAttribute($key, $value);
    }
}
