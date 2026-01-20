<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GedungRequest extends FormRequest
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
            'jumlah_lantai' => 'nullable|string',
            'lokasi' => 'nullable|string',
            'titik_koordinat' => 'nullable|string',
            'status_kepemilikan_tanah' => 'nullable|string',
            'jumlah' => 'nullable|string',
            'satuan' => 'nullable|string',
            'harga_satuan' => 'nullable|numeric',
            'nilai_perolehan' => 'nullable|numeric',
            'tanggal_perolehan' => 'nullable|date',
            'cara_perolehan' => 'nullable|string',
            'status_penggunaan' => 'nullable|string',
            'keterangan' => 'nullable|string',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5120',
        ];
    }
}
