<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Laravel\Sanctum\HasApiTokens;

class Kir extends Model
{
    use HasFactory, HasApiTokens;

    protected $fillable = [
        'tanah_id',
        'gedung_id',
        'mesin_id',
        'nama_barang',
        'kode_barang',
        'tanggal_perolehan',
        'lokasi',
        'kondisi',
        'jumlah',
        'nilai_perolehan',
        'gambar_qr',
        'gambar',
    ];

    public function tanah()
    {
        return $this->belongsTo(KibTanah::class);
    }
    public function gedung()
    {
        return $this->belongsTo(KibGedung::class);
    }

    public function mesin()
    {
        return $this->belongsTo(KibMesin::class);
    }
}
