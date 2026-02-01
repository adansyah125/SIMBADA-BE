<?php

namespace App\Services;

use App\Models\Berita;

class BeritaService
{
    public function getAll()
    {
        return Berita::with('mesin')->get();
    }

    public function create(array $data)
    {
        return Berita::create($data);
    }

    public function delete($id)
    {
        $berita = Berita::findOrFail($id);
        return $berita->delete();
    }
}
