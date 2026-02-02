<?php

namespace App\Http\Controllers;

use App\Models\Kir;
use App\Traits\ApiResponer;
use App\Services\KirService;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Http\Requests\KirRequest;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Throwable;

class KirController extends Controller
{
    use ApiResponer;

    protected KirService $kirService;

    public function __construct(KirService $kirService)
    {
        $this->kirService = $kirService;
    }

    public function index(Request $request)
    {
        try {
            $search = $request->query('search');
            $data = $this->kirService->getAll($search);
            return $this->successResponse($data, 'Data Tanah berhasil diambil', 200);
        } catch (ModelNotFoundException $e) {
            return $this->errorResponse('Data tanah tidak ditemukan', 404);
        } catch (Throwable $e) {
            return $this->errorResponse('Terjadi kesalahan pada server', 500);
        }
    }

    public function store(KirRequest $request)
    {
        $kir = $this->kirService->store($request->validated(), $request);
        return $this->successResponse($kir, 'KIR berhasil dibuat', 200);
    }

    public function show(Kir $kir)
    {
        return $this->successResponse($kir);
    }

    public function update(KirRequest $request, Kir $kir)
    {

        $kir = $this->kirService->update($kir, $request->validated(), $request);
        return $this->successResponse($kir, 'KIR berhasil diperbarui');
    }

    public function destroy(Kir $kir)
    {
        $this->kirService->delete($kir);
        return $this->successResponse(null, 'KIR berhasil dihapus');
    }

    public function cetakLabel(Request $request)
    {
        $ids = $request->ids; // array ID dari FE

        $items = Kir::whereIn('id', $ids)->get();

        $pdf = Pdf::loadView('pdf.kir-label', [
            'items' => $items
        ])
            ->setPaper('A4', 'portrait');

        return $pdf->download('label-kir.pdf');
        // atau ->stream() kalau mau preview
    }

    public function lokasi()
    {
        $data = Kir::select(
            'id',
            'kode_barang',
            'nama_barang',
            'kondisi',
            'lokasi',
            'gambar_qr'
        )
            ->orderBy('lokasi')
            ->get()
            ->groupBy('lokasi')
            ->map(function ($items, $lokasi) {
                return [
                    'lokasi' => $lokasi,
                    'items'  => $items->values(),
                ];
            })
            ->values();

        return response()->json($data);
    }
}
