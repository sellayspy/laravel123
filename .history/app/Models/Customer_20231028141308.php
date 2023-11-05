<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Customer extends Model
{
    use HasFactory;

    /**
     * The roles that belong to the Customer
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function d_juals(): BelongsToMany
    {
        return $this->belongsToMany(D_jual::class);
    }

    /**
     * Get all of the comments for the Customer
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasManyThrough
     */
    public function barangs(): HasManyThrough
    {
        return $this->hasManyThrough(Barangs::class, D_jual::class);
    }
}
