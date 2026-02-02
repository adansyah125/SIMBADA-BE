<?php

namespace App\Http\Controllers;

use Throwable;
use App\Models\Berita;
use App\Traits\ApiResponer;
use App\Services\BeritaService;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Http\Requests\BeritaRequest;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class BeritaController extends Controller
{
    use ApiResponer;

    protected $beritaService;

    public function __construct(BeritaService $beritaService)
    {
        $this->beritaService = $beritaService;
    }

    public function index()
    {
        try {
            $data = $this->beritaService->getAll();
            return $this->successResponse($data, 'Data berhasil diambil', 200);
        } catch (ModelNotFoundException $e) {
            return $this->errorResponse('Data tidak ditemukan', 404);
        } catch (Throwable $e) {
            return $this->errorResponse('Terjadi kesalahan pada server', 500);
        }
    }

    public function store(BeritaRequest $request)
    {
        $data = $this->beritaService->create($request->validated());
        return $this->successResponse($data, 'Data berhasil Ditambahkan', 200);
    }


    public function destroy($id)
    {
        $this->beritaService->delete($id);
        return $this->successResponse(null, 'Data  berhasil Dihapus', 200);
    }

    public function pdf($id)
    {
        $berita = Berita::with('mesin')->findOrFail($id);

        $pdf = Pdf::loadView('pdf.berita_acara', [
            'berita' => $berita
        ])->setPaper('a3', 'portrait');

        return $pdf->stream("berita-acara.pdf");
    }
}
