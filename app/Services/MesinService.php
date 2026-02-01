<?php

namespace App\Services;

use App\Models\KibMesin;
use Illuminate\Support\Facades\Storage;

class MesinService
{
    public function getAll($search = null)
    {
        $query = KibMesin::query();

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('nama_barang', 'like', "%{$search}%")
                    ->orWhere('kode_barang', 'like', "%{$search}%")
                    ->orWhere('no_polisi', 'like', "%{$search}%");
            });
        }

        return $query->latest()->paginate(10);
    }

    public function getNoPaginate()
    {
        return KibMesin::all();
    }

    public function create(array $data)
    {
        return KibMesin::create($data);
    }

    public function getById($id)
    {
        return KibMesin::findOrFail($id);
    }

    public function update($id, array $data)
    {
        $KibMesin = $this->getById($id);
        $KibMesin->update($data);
        return $KibMesin;
    }

    public function delete($id)
    {
        $KibMesin = $this->getById($id);
        return $KibMesin->delete();
    }
}
