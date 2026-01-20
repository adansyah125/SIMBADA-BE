<?php

namespace App\Models;

use App\Models\Kir;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class KibGedung extends Model
{
    use HasFactory, HasApiTokens;

    protected $fillable = [
        'kode_barang',
        'nama_barang',
        'nibar',
        'no_register',
        'spesifikasi_nama_barang',
        'spesifikasi_lainnya',
        'jumlah_lantai',
        'lokasi',
        'titik_koordinat',
        'status_kepemilikan_tanah',
        'jumlah',
        'satuan',
        'harga_satuan',
        'nilai_perolehan',
        'cara_perolehan',
        'tanggal_perolehan',
        'status_penggunaan',
        'keterangan',
        'gambar'
    ];

    public function kir()
    {
        return $this->hasMany(Kir::class);
    }
}
