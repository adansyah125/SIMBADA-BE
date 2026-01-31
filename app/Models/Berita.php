<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;

class Berita extends Model
{
    use HasFactory, HasApiTokens;

    protected $fillable = [
        'mesin_id',
        'nama',
        'nip',
        'jabatan',
        'jumlah',
        'tanggal'
    ];

    public function mesin()
    {
        return $this->belongsTo(KibMesin::class);
    }
}
