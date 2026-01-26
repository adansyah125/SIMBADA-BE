<?php

namespace App\Imports;

use Carbon\Carbon;
use App\Models\KibMesin;
use App\Models\KibGedung;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToModel;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\SkipsEmptyRows;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Imports\HeadingRowFormatter;

HeadingRowFormatter::default('none');
class KibMesinImport implements ToModel, WithHeadingRow, SkipsEmptyRows
{
    public function model(array $row)
    {
        // WAJIB ada kode_barang
        if (empty($row['kode_barang'])) {
            return null; // skip baris kosong / rusak
        }

        // Skip baris kategori besar (seperti "PERALATAN DAN MESIN")
        if ($row['nama_barang'] === 'PERALATAN DAN MESIN') {
            return null;
        }
        $tanggal = $row['tanggal_perolehan'] ?? null;

        if (!empty($tanggal)) {
            if (is_numeric($tanggal)) {
                // Excel serial date (benar-benar date murni)
                $tanggal = Date::excelToDateTimeObject($tanggal)->format('Y-m-d');
            } else {
                // Sudah string (walaupun format date di Excel)
                try {
                    $tanggal = Carbon::parse($tanggal)->format('Y-m-d');
                } catch (\Exception $e) {
                    $tanggal = null; // kalau benar-benar rusak
                }
            }
        }
        return new KibMesin([
            'kode_barang' => trim((string) $row['kode_barang']),
            'nama_barang' => $row['nama_barang'] ?? null,
            'nibar' => $row['nibar'] ?? null,
            'no_register' => $row['no_register'] ?? null,
            'spesifikasi_nama_barang' => $row['spesifikasi_nama_barang'] ?? null,
            'spesifikasi_lainnya' => $row['spesifikasi_lainnya'] ?? null,
            'merk' => $row['merk'] ?? null,
            'lokasi' => $row['lokasi'] ?? null,
            'no_polisi' => $row['no_polisi'] ?? null,
            'no_rangka' => $row['no_rangka'] ?? null,
            'no_bpkb' => $row['no_bpkb'] ?? null,
            'jumlah' => $row['jumlah'] ?? null,
            'satuan' => $row['satuan'] ?? null,
            'harga_satuan' => $row['harga_satuan'] ?? null,
            'nilai_perolehan' => $this->indoNumberToDecimal($row['nilai_perolehan'] ?? null),
            'cara_perolehan' => $row['cara_perolehan'] ?? null,
            'tanggal_perolehan' => $tanggal,
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
}
