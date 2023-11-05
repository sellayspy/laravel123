<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class D_jual extends Model
{
    use HasFactory;


    /**
     * Get all of the comments for the D_jual
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function barangs(): HasMany
    {
        return $this->hasMany(Barang::class);
    }

    /**
     * The roles that belong to the D_jual
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function customers(): BelongsToMany
    {
        return $this->belongsToMany(Customer::class,'h_juals',foreignPivotKey: 'customer_id', foreignPivotKey: 'd_jual_id')->withTimestamps();
    }
}
