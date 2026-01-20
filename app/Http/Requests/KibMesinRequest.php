<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class KibMesinRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'kode_barang' => 'required|string|max:255',
            'nama_barang' => 'required|string|max:255',
            'nibar' => 'nullable|string',
            'no_register' => 'nullable|string',
            'spesifikasi_nama_barang' => 'nullable|string',
            'spesifikasi_lainnya' => 'nullable|string',
            'merk' => 'nullable|string',
            'lokasi' => 'nullable|string',
            'no_polisi'       => 'nullable|string',
            'no_rangka' => 'nullable|string',
            'no_bpkb' => 'nullable|string',
            'jumlah' => 'nullable|string',
            'satuan' => 'nullable|string',
            'harga_satuan' => 'nullable|numeric',
            'nilai_perolehan'     => 'nullable|numeric',
            'tanggal_perolehan' => 'nullable|date',
            'cara_perolehan' => 'nullable|string',
            'status_penggunaan' => 'nullable|string',
            'keterangan' => 'nullable|string',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5120',
        ];
    }
}
