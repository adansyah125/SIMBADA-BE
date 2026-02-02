<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Laravel\Sanctum\HasApiTokens;

class Integritas extends Model
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
