<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

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
     * Get the user that owns the D_jual
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function customers(): BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }
}
