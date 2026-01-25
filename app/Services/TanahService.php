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


    public function create(array $data)
    {
        return KibTanah::create($data);
    }

    public function getById($id)
    {
        return KibTanah::findOrFail($id);
    }

    public function update($id, array $data)
    {
        $kibTanah = $this->getById($id);
        $kibTanah->update($data);
        return $kibTanah;
    }

    public function delete($id)
    {
        $kibTanah = $this->getById($id);
        return $kibTanah->delete();
    }
}
