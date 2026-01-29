<?php

namespace App\Exports;

use App\Models\KibGedung;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;

class GedungExport implements
    FromCollection,
    WithHeadings,
    WithMapping,
    WithColumnFormatting
{
    public function collection()
    {
        return KibGedung::select(
            'kode_barang',
            'nama_barang',
            'nibar',
            'no_register',
            'spesifikasi_nama_barang',
            'spesifikasi_lainnya',
            'jumlah_lantai',
            'lokasi',
            'titik_koordinat',
            'status_kepemilikan_tanah',
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
            (float)$row->kode_barang,
            $row->nama_barang,
            $row->nibar,
            $row->no_register,
            $row->spesifikasi_nama_barang,
            $row->spesifikasi_lainnya,
            $row->jumlah_lantai,
            $row->lokasi,
            $row->titik_koordinat,
            $row->status_kepemilikan_tanah,
            $row->jumlah,
            $row->satuan,
            (float) $row->harga_satuan,            // NUMBER
            (float) $row->nilai_perolehan,         // NUMBER
            $row->tanggal_perolehan,               // DATE (RAW)
            $row->cara_perolehan,
            $row->status_penggunaan,
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
            'jumlah_lantai',
            'lokasi',
            'titik_koordinat',
            'status_kepemilikan_tanah',
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
