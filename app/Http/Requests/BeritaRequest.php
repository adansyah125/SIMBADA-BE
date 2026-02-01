<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BeritaRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'mesin_id' => 'required|exists:kib_mesins,id',
            'nama' => 'required|string|max:255',
            'nip' => 'required|string|max:255',
            'jabatan' => 'required|string|max:255',
            'tanggal' => 'required|date',
            'jumlah' => 'required|integer',
        ];
    }
}
