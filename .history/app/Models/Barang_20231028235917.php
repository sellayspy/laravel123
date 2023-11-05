<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Barang extends Model
{
    use HasFactory;

    protected $fillable = [
        'kdBarang',
        'nmBarang',
        'satuan',
        'hargaSatuan',
        'stock',
        'tglExpired'
    ];

    public function toSearchableArray()
    {
        return [
            'kdBarang' => $this->kdBarang,
            'nmBarang' => $this->nmBarang
        ];
    }
}
