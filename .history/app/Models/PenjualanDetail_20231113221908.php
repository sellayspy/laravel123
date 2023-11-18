<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PenjualanDetail extends Model
{
    use HasFactory;
    use HasFactory;
    protected $table = 'penjualanDetail';
    protected $primaryKey = 'id_penjualanDetail';
    protected $guarded = [];
}
