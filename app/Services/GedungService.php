<?php

namespace App\Services;

use App\Models\KibGedung;
use Illuminate\Support\Facades\Storage;

class GedungService
{
    public function getAll($search = null)
    {
        $query = KibGedung::query();

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('nama_barang', 'like', "%{$search}%")
                    ->orWhere('kode_barang', 'like', "%{$search}%");
            });
        }

        return $query->latest()->paginate(10);
    }

    public function create(array $data)
    {
        return KibGedung::create($data);
    }

    public function getById($id)
    {
        return KibGedung::findOrFail($id);
    }

    public function update($id, array $data)
    {
        $KibGedung = $this->getById($id);
        $KibGedung->update($data);
        return $KibGedung;
    }

    public function delete($id)
    {
        $KibGedung = $this->getById($id);
        return $KibGedung->delete();
    }
}
