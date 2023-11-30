<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SuplierSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Suplier::create([
            'namaSuplier'   => str_random(10),
            'alamat'        => str_random(10),
            'noTelepon'     => str_random(10)
        ]);
    }
}
