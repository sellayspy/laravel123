<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;
use Illuminate\Notifications\Notifiable;

class Barang extends Model
{
    use HasFactory, Notifiable , Searchable;

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
