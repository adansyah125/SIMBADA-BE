<?php

namespace App\Models;

use App\Models\Kir;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class KibMesin extends Model
{
    use HasFactory, HasApiTokens;

    protected $fillable = [
        'kode_barang',
        'nama_barang',
        'nibar',
        'no_register',
        'spesifikasi_nama_barang',
        'spesifikasi_lainnya',
        'merk',
        'lokasi',
        'no_polisi',
        'no_rangka',
        'no_bpkb',
        'jumlah',
        'satuan',
        'harga_satuan',
        'nilai_perolehan',
        'cara_perolehan',
        'tanggal_perolehan',
        'status_penggunaan',
        'keterangan',
    ];

    public function kir()
    {
        return $this->hasMany(Kir::class);
    }

    public function berita()
    {
        return $this->hasMany(Berita::class);
    }
}
