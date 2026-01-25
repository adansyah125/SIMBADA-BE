<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class KirRequest extends FormRequest
{

    public function rules(): array
    {
        return [
            'tanah_id' => 'nullable|exists:kib_tanahs,id',
            'gedung_id' => 'nullable|exists:kib_gedungs,id',
            'mesin_id' => 'nullable|exists:kib_mesins,id',
            'nama_barang' => 'required',
            'kode_barang' => 'required',
            'tanggal_perolehan' => 'required|date',
            'lokasi' => 'required',
            'kondisi' => 'required|in:baik,kurang baik,rusak berat',
            'jumlah' => 'required|integer',
            'nilai_perolehan' => 'required|numeric',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:5120',
        ];
    }
}
