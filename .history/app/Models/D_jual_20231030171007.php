<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;


class D_jual extends Model
{
    use HasFactory;
    protected $table = 'd_juals';
    protected $primaryKey = 'juals_id';


    /**
     * Get all of the comments for the D_jual
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function barang(): HasOne
    {
        return $this->hasOne(Barang::class,'barang_id','barang_id');
    }

}
