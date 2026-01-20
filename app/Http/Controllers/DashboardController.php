<?php

namespace App\Http\Controllers;

use App\Models\Kir;
use App\Models\KibMesin;
use App\Models\KibTanah;
use App\Models\KibGedung;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // 1. TOTAL VALUASI
        $totalValuasi =
            KibTanah::sum('nilai_perolehan') +
            KibGedung::sum('nilai_perolehan') +
            KibMesin::sum('nilai_perolehan');

        // 2. TOTAL FISIK
        $totalFisik =
            KibTanah::count() +
            KibGedung::count() +
            KibMesin::count();

        // 3. RUSAK BERAT
        $rusakBerat = Kir::where('kondisi', 'rusak berat')->count();

        // 4. BAR CHART
        $barChart = [
            'tanah'  => KibTanah::count(),
            'gedung' => KibGedung::count(),
            'mesin'  => KibMesin::count(),
        ];

        // 5. SEBARAN LOKASI (berdasarkan kondisi)
        $sebaranLokasi = Kir::selectRaw('lokasi, kondisi, COUNT(*) as total')
            ->groupBy('lokasi', 'kondisi')
            ->get()
            ->groupBy('lokasi');

        return response()->json([
            'data' => [
                'total_valuasi' => $totalValuasi,
                'total_fisik'   => $totalFisik,
                'rusak_berat'   => $rusakBerat,
                'bar_chart'     => $barChart,
                'sebaran_lokasi' => $sebaranLokasi,
            ]
        ]);
    }
}
