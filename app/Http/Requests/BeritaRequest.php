<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BeritaRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'mesin_id' => 'required|exists:kib_mesins,id',
            'nama_pihak1' => 'required|string|max:255',
            'nip_pihak1' => 'required|string|max:255',
            'jabatan_pihak1' => 'required|string|max:255',
            'nama_pihak2' => 'required|string|max:255',
            'nip_pihak2' => 'required|string|max:255',
            'jabatan_pihak2' => 'required|string|max:255',
            'tanggal' => 'required|date',
            'jumlah' => 'required|integer',
        ];
    }
}
