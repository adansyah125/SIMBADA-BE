<?php

namespace Database\Seeders;

use App\Models\Kir;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class KirSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $kir = Kir::create([
            'tanah_id' => 1,
            'gedung_id' => 1,
            'mesin_id' => 1,
            'nama_barang' => 'Tanah A',
            'kode_barang' => '123',
            'tahun' => now(),
            'lokasi' => 'Bandung',
            'kondisi' => 'baik',
            'jumlah' => 5,
            'nilai_perolehan' => 100000,
            'gambar_qr' => null,
        ]);
        // Generate QR
        $qrData = url('/kir/' . $kir->id);
        $qrName = 'qr_' . time() . '_' . $kir->id . '.svg';
        $qrPath = 'qrcodes/' . $qrName;

        $qrImage = QrCode::format('svg')->size(300)->generate($qrData);
        Storage::disk('public')->put($qrPath, $qrImage);

        $kir->update([
            'gambar_qr' => $qrPath
        ]);
    }
}
