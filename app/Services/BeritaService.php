<?php

namespace App\Services;

use App\Models\Berita;

class BeritaService
{
    public function getAll()
    {
        return Berita::all();
    }
}
