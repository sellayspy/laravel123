<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SettingTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('setting')->insert([
            'id_setting'           => 1,
            'namaPerusahaan'       => 'Kasirku',
            'alamat'               => 'Palembang',
            'telepon'              => '081245676543',
            'tipe_nota'            => 1,
            'patchLogo'            => public_path('/img/logo.png'),
            'patch_kartu_customer' => public_path('/img/katuprakerja.png'),
        ]);
    }
}
