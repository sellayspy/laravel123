<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;

class H_jual extends Pivot
{
    use HasFactory;
    protected $table = 'h_juals';
}
