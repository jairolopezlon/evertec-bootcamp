<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Admin extends Model
{
    use HasFactory;

    protected $fillable = [
        'is_superadmin',
        'role',
        'user_id',
    ];

    /**
     * Get the user that owns the admin.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne<User>
     */
    public function user(): HasOne
    {
        return $this->hasOne(User::class);
    }
}
