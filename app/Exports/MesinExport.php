<?php

namespace App\Exports;

use App\Models\KibMesin;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;

class MesinExport implements
    FromCollection,
    WithHeadings,
    WithMapping,
    WithColumnFormatting
{
    public function collection()
    {
        return KibMesin::select(
            'kode_barang',
            'nama_barang',
            'nibar',
            'no_register',
            'spesifikasi_nama_barang',
            'spesifikasi_lainnya',
            'merk',
            'lokasi',
            'no_polisi',
            'no_rangka',
            'no_bpkb',
            'jumlah',
            'satuan',
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
            $row->merk,                  // NUMBER
            $row->lokasi,                          // TEXT
            $row->no_polisi,                 // TEXT
            $row->no_rangka,                            // TEXT
            $row->no_bpkb,                           // TEXT
            $row->jumlah,                         // DATE (RAW)
            $row->satuan,                // TEXT
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
            'merk',
            'lokasi',
            'no_polisi',
            'no_rangka',
            'no_bpkb',
            'jumlah',
            'satuan',
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
