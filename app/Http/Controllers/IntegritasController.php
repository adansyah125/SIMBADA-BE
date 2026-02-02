<?php

namespace App\Http\Controllers;

use Throwable;
use Carbon\Carbon;
use App\Models\Integritas;
use App\Traits\ApiResponer;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Services\IntegritasService;
use App\Http\Requests\BeritaRequest;
use App\Http\Requests\IntegritasRequest;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class IntegritasController extends Controller
{
    use ApiResponer;

    protected $integritasService;

    public function __construct(IntegritasService $integritasService)
    {
        $this->integritasService = $integritasService;
    }

    public function index()
    {
        try {
            $data = $this->integritasService->getAll();
            return $this->successResponse($data, 'Data berhasil diambil', 200);
        } catch (ModelNotFoundException $e) {
            return $this->errorResponse('Data tidak ditemukan', 404);
        } catch (Throwable $e) {
            return $this->errorResponse('Terjadi kesalahan pada server', 500);
        }
    }

    public function store(IntegritasRequest $request)
    {
        $data = $this->integritasService->create($request->validated());
        return $this->successResponse($data, 'Data berhasil Ditambahkan', 200);
    }


    public function destroy($id)
    {
        $this->integritasService->delete($id);
        return $this->successResponse(null, 'Data  berhasil Dihapus', 200);
    }

    public function pdf($id)
    {
        $data = Integritas::with('mesin')->findOrFail($id);

        Carbon::setLocale('id');

        $tanggal = Carbon::parse($data->tanggal)
            ->translatedFormat('d F Y');

        $pdf = Pdf::loadView('pdf.integritas', [
            'data' => $data,
            'tanggal' => $tanggal
        ])->setPaper('a4', 'portrait');

        return $pdf->download('pakta-integritas-' . $data->nama . '.pdf');
    }
}
