<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class TanahSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('kib_tanahs')->insert([
            'kode_barang' => 'BRG-2024-001',
            'nama_barang' => 'Laptop MacBook Pro',
            'nibar' => '12345678',
            'no_register' => 'REG/2024/001',
            'spesifikasi_nama_barang' => 'Apple M2 Chip',
            'spesifikasi_lainnya' => 'RAM 16GB, SSD 512GB',
            'jumlah' => '1',
            'satuan' => 'unit',
            'lokasi' => 'Ruang IT Lantai 2',
            'titik_koordinat' => '-6.200000, 106.816666',

            // Bukti Kepemilikan
            'nama' => 'Sertifikat Inventaris Kantor',
            'nomor' => 'INV/SK/2024/X',
            'tanggal' => '2024-01-15',
            'nama_kepemilikan' => 'PT. Maju Bersama',

            'harga_satuan' => 25000000.00,
            'nilai_perolehan' => 25000000.00,
            'tanggal_perolehan' => '2024-01-10',
            'cara_perolehan' => 'Pengadaan APBD',
            'status_penggunaan' => 'Aktif',
            'keterangan' => 'Barang baru dalam kondisi baik',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
