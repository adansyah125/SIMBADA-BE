<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class MesinSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('kib_mesins')->insert([
            'kode_barang' => '55721313',
            'nama_barang' => 'Astrea Grand',
            'no_polisi' => 'D 3075 CH',
            'no_bpkb' => 'D 3075 CH',
            'no_rangka' => 'D 3075 CH',
            'nilai_perolehan' => '1000000',
        ]);
    }
}
