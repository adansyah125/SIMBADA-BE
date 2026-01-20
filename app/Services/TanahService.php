<?php

namespace App\Services;

use App\Models\KibTanah;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class TanahService
{
    public function getAll()
    {
        return KibTanah::latest()->get();
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
        return KibTanah::create($data);
    }

    public function getById($id)
    {
        return KibTanah::findOrFail($id);
    }

    public function update($id, array $data, $request = null)
    {
        $kibTanah = $this->getById($id);

        // Hanya ganti gambar jika user mengunggah file baru
        if ($request && $request->hasFile('gambar')) {
            // Hapus yang lama
            if ($kibTanah->gambar) {
                Storage::disk('public')->delete($kibTanah->gambar);
            }
            // Simpan yang baru
            $data['gambar'] = $request->file('gambar')->store('kib', 'public');
        } else {
            // Jika tidak ada file baru, hapus 'gambar' dari array $data 
            // agar kolom 'gambar' di DB tidak tertimpa/error
            unset($data['gambar']);
        }
        $kibTanah->update($data);
        return $kibTanah;
    }

    public function delete($id)
    {
        $kibTanah = $this->getById($id);
        // 1. Cek apakah ada path gambar di database
        if ($kibTanah->gambar) {
            // 2. Hapus file fisik dari folder storage/app/public/kib
            Storage::disk('public')->delete($kibTanah->gambar);
        }
        return $kibTanah->delete();
    }
}
