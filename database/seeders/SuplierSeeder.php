<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class SuplierSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('supliers')->insert([
            'namaSuplier' => Str::random(10),
            'alamat' => Str::random(10),
            'noTelepon' => Str::random(10),
        ]);
    }
}
