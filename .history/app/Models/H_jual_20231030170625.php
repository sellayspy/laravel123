<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
class H_jual extends Model
{
    use HasFactory;
    protected $table = 'h_juals';
    protected $primaryKey = 'h_jual_id';
}
/**
 * Get the user associated with the H_jual
 *
 * @return \Illuminate\Database\Eloquent\Relations\HasOne
 */
public function customer(): HasOne
{
    return $this->hasOne(Customer::class, 'customer_id', 'customer_id');
}
