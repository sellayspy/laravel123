<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use ne

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

         * The roles that belong to the D_jual
         *
         * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
         */
        public function roles(): BelongsToMany
        {
            return $this->belongsToMany(Role::class, 'role_user_table', 'user_id', 'role_id');
        }(Customer::class);
    }
}
