<?php

namespace App\Exports;

use App\Models\KibTanah;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;

class TanahExport implements
    FromCollection,
    WithHeadings,
    WithMapping,
    WithColumnFormatting
{
    public function collection()
    {
        return KibTanah::select(
            'kode_barang',
            'nama_barang',
            'nibar',
            'no_register',
            'spesifikasi_nama_barang',
            'spesifikasi_lainnya',
            'jumlah',
            'satuan',
            'lokasi',
            'titik_koordinat',
            'nama',
            'nomor',
            'tanggal',
            'nama_kepemilikan',
            'harga_satuan',
            'nilai_perolehan',
            'tanggal_perolehan',
            'cara_perolehan',
            'status_penggunaan',
            'keterangan',
        )->get();
    }

    /**
     * Mapping data → menentukan tipe data (number/date)
     */
    public function map($row): array
    {
        return [
            (float)$row->kode_barang,                     // TEXT
            $row->nama_barang,                     // TEXT
            $row->nibar,                            // TEXT
            $row->no_register,                     // TEXT
            $row->spesifikasi_nama_barang,          // TEXT
            $row->spesifikasi_lainnya,             // TEXT
            (float) $row->jumlah,                  // NUMBER
            $row->satuan,                          // TEXT
            $row->lokasi,                          // TEXT
            $row->titik_koordinat,                 // TEXT
            $row->nama,                            // TEXT
            $row->nomor,                           // TEXT
            $row->tanggal,                         // DATE (RAW)
            $row->nama_kepemilikan,                // TEXT
            (float) $row->harga_satuan,            // NUMBER
            (float) $row->nilai_perolehan,         // NUMBER
            $row->tanggal_perolehan,               // DATE (RAW)
            $row->cara_perolehan,                  // TEXT
            $row->status_penggunaan,               // TEXT
            $row->keterangan
        ];
    }

    /**
     * Header Excel
     */
    public function headings(): array
    {
        return [
            'kode_barang',
            'nama_barang',
            'nibar',
            'no_register',
            'spesifikasi_nama_barang',
            'spesifikasi_lainnya',
            'jumlah',
            'satuan',
            'lokasi',
            'titik_koordinat',
            'nama',
            'nomor',
            'tanggal',
            'nama_kepemilikan',
            'harga_satuan',
            'nilai_perolehan',
            'tanggal_perolehan',
            'cara_perolehan',
            'status_penggunaan',
            'keterangan',
        ];
    }

    /**
     * Format kolom Excel
     */
    public function columnFormats(): array
    {
        return [
            'F' => NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1, // Harga
            'G' => NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1, // Nilai
            'H' => NumberFormat::FORMAT_DATE_DDMMYYYY,           // Tanggal
        ];
    }
}
