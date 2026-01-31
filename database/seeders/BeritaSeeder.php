<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class BeritaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('beritas')->insert([
            'mesin_id' => 1854,
            'nama' => 'Asep',
            'nip' => '123',
            'jabatan' => 'Kepala',
            'jumlah' => '1',
            'tanggal' => now(),
        ]);
    }
}
