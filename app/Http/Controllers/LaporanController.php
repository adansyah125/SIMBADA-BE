<?php

namespace App\Http\Controllers;

use App\Models\Kir;
use App\Traits\ApiResponer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LaporanController extends Controller
{

    public function rekapAset()
    {
        $tanah = Kir::whereNotNull('tanah_id')->select(
            DB::raw('COALESCE(SUM(jumlah),0) as total'),
            DB::raw("COALESCE(SUM(CASE WHEN kondisi = 'baik' THEN jumlah ELSE 0 END),0) as baik"),
            DB::raw("COALESCE(SUM(CASE WHEN kondisi = 'rusak berat' THEN jumlah ELSE 0 END),0) as rusak")
        )->first();

        $gedung = Kir::whereNotNull('gedung_id')->select(
            DB::raw('COALESCE(SUM(jumlah),0) as total'),
            DB::raw("COALESCE(SUM(CASE WHEN kondisi = 'baik' THEN jumlah ELSE 0 END),0) as baik"),
            DB::raw("COALESCE(SUM(CASE WHEN kondisi = 'rusak berat' THEN jumlah ELSE 0 END),0) as rusak")
        )->first();

        $mesin = Kir::whereNotNull('mesin_id')->select(
            DB::raw('COALESCE(SUM(jumlah),0) as total'),
            DB::raw("COALESCE(SUM(CASE WHEN kondisi = 'baik' THEN jumlah ELSE 0 END),0) as baik"),
            DB::raw("COALESCE(SUM(CASE WHEN kondisi = 'rusak berat' THEN jumlah ELSE 0 END),0) as rusak")
        )->first();

        return response()->json([
            'tanah'  => $tanah->toArray(),
            'gedung' => $gedung->toArray(),
            'mesin'  => $mesin->toArray(),
        ]);
    }


    public function cetak(Request $request)
    {
        $kondisi = $request->query('kondisi');

        $query = Kir::query();

        if ($kondisi === 'baik') {
            $query->where('kondisi', 'baik');
        } elseif ($kondisi === 'kurang_baik') {
            $query->where('kondisi', 'kurang baik');
        } elseif ($kondisi === 'rusak_berat') {
            $query->where('kondisi', 'rusak berat');
        }
        // "semua" → tanpa filter

        $data = $query->orderBy('nama_barang')->get();

        return view('kir.cetak', compact('data', 'kondisi'));
    }
}
