<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    use HasFactory;
    protected $table = 'barangs';
    protected $primaryKey = 'barang_id';
    protected $fillable = [
        'kdBarang',
        'nmBarang',
        'satuan',
        'hargaSatuan',
        'stock',
        'tglExpired'
    ];
}
