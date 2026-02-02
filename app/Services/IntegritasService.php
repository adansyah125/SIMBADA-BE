<?php

namespace App\Services;

use App\Models\Integritas;

class IntegritasService
{
    public function getAll()
    {
        return Integritas::with('mesin')->get();
    }

    public function create(array $data)
    {
        return Integritas::create($data);
    }

    public function delete($id)
    {
        $integritas = Integritas::findOrFail($id);
        return $integritas->delete();
    }
}
