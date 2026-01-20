<?php

namespace App\Imports;

use Carbon\Carbon;
use App\Models\KibTanah;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToModel;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class KibTanahImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        return new KibTanah([
            'kode_barang' => $row['kode_barang'],
            'nama_barang' => $row['nama_barang'],
            'nibar' => $row['nibar'] ?? null,
            'no_register' => $row['no_register'] ?? null,
            'spesifikasi_nama_barang' => $row['spesifikasi_nama_barang'] ?? null,
            'spesifikasi_lainnya' => $row['spesifikasi_lainnya'] ?? null,
            'jumlah' => $row['jumlah'] ?? null,
            'satuan' => $row['satuan'] ?? null,
            'lokasi' => $row['lokasi'] ?? null,
            'titik_koordinat' => $row['titik_koordinat'] ?? null,
            'nama' => $row['nama'] ?? null,
            'nomor' => $row['nomor'] ?? null,
            'tanggal' => isset($row['tanggal'])
                ? Carbon::instance(Date::excelToDateTimeObject($row['tanggal']))
                ->format('Y-m-d')
                : null,
            'nama_kepemilikan' => $row['nama_kepemilikan'] ?? null,
            'harga_satuan' => $row['harga_satuan'] ?? null,
            'nilai_perolehan' => $this->indoNumberToDecimal($row['nilai_perolehan'] ?? null),
            'tanggal_perolehan' => isset($row['tanggal_perolehan'])
                ? Carbon::instance(Date::excelToDateTimeObject($row['tanggal_perolehan']))
                ->format('Y-m-d')
                : null,
            'cara_perolehan' => $row['cara_perolehan'] ?? null,
            'status_penggunaan' => $row['status_penggunaan'] ?? null,
            'keterangan' => $row['keterangan'] ?? null,
        ]);
    }

    private function indoNumberToDecimal($value)
    {
        if ($value === null || $value === '') {
            return null;
        }

        // Jika Excel sudah kirim numeric murni
        if (is_numeric($value)) {
            return $value;
        }

        // Hapus pemisah ribuan (.)
        $value = str_replace('.', '', $value);

        // Ganti koma desimal jadi titik
        $value = str_replace(',', '.', $value);

        return is_numeric($value) ? (float) $value : null;
    }


    private function cleanNumber($value)
    {
        if ($value === null) return null;

        return (float) str_replace(
            [',', '.', 'Rp', ' ', ' '],
            '',
            $value
        );
    }

    private function rupiahToDecimal($value)
    {
        if ($value === null) return null;

        // Hapus Rp dan spasi
        $value = str_replace(['Rp', ' '], '', $value);

        // Hapus titik ribuan
        $value = str_replace('.', '', $value);

        // Ganti koma jadi titik (desimal)
        $value = str_replace(',', '.', $value);

        return is_numeric($value) ? (float) $value : null;
    }
}
