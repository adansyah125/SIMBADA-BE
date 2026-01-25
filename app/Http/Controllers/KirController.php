<?php

namespace App\Http\Controllers;

use App\Models\Kir;
use App\Traits\ApiResponer;
use App\Services\KirService;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Http\Requests\KirRequest;

class KirController extends Controller
{
    use ApiResponer;

    protected KirService $kirService;

    public function __construct(KirService $kirService)
    {
        $this->kirService = $kirService;
    }

    public function index()
    {
        return $this->successResponse(Kir::latest()->get());
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
}
