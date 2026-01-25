<?php

namespace App\Services;

use App\Models\KibMesin;
use Illuminate\Support\Facades\Storage;

class MesinService
{
    public function getAll()
    {
        return KibMesin::latest()->get();
    }

    public function create(array $data, $request = null)
    {
        // Cek apakah ada file 'gambar' di dalam request
        if ($request && $request->hasFile('gambar')) {
            // Simpan gambar ke folder 'storage/app/public/kib'
            $path = $request->file('gambar')->store('kib', 'public');

            // Masukkan path gambar ke dalam array data untuk disimpan ke kolom 'gambar' di DB
            $data['gambar'] = $path;
        }

        // Pastikan kode_barang ada agar tidak kena error 1048
        if (empty($data['kode_barang'])) {
            throw new \Exception("Kolom kode_barang tidak boleh kosong.");
        }
        return KibMesin::create($data);
    }

    public function getById($id)
    {
        return KibMesin::findOrFail($id);
    }

    public function update($id, array $data, $request = null)
    {
        $KibMesin = $this->getById($id);
        // Cek jika ada unggahan gambar baru
        if ($request && $request->hasFile('gambar')) {
            // 1. Hapus gambar lama jika ada di storage
            if ($KibMesin->gambar) {
                Storage::disk('public')->delete($KibMesin->gambar);
            }

            // 2. Simpan gambar baru
            $data['gambar'] = $request->file('gambar')->store('kib', 'public');
        }
        $KibMesin->update($data);
        return $KibMesin;
    }

    public function delete($id)
    {
        $KibMesin = $this->getById($id);
        $KibGedung = $this->getById($id);
        // 1. Cek apakah ada path gambar di database
        if ($KibGedung->gambar) {
            // 2. Hapus file fisik dari folder storage/app/public/kib
            Storage::disk('public')->delete($KibGedung->gambar);
        }
        return $KibMesin->delete();
    }
}
