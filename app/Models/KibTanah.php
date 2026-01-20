<?php

namespace App\Models;

use App\Models\Kir;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class KibTanah extends Model
{
    use HasFactory, HasApiTokens;

    protected $fillable = [
        'kode_barang',
        'nama_barang',
        'nibar',
        'no_register',
        'spesifikasi_nama_barang',
        'spesifikasi_lainnya',
        'jumlah',
        'satuan',
        'lokasi',
        'titik_koordinat',
        'nama',
        'nomor',
        'tanggal',
        'nama_kepemilikan',
        'harga_satuan',
        'nilai_perolehan',
        'tanggal_perolehan',
        'cara_perolehan',
        'status_penggunaan',
        'keterangan',
        'gambar'
    ];

    public function kir()
    {
        return $this->hasMany(Kir::class);
    }
}
