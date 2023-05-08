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
