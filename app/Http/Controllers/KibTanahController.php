<?php

namespace App\Http\Controllers;

use App\Exports\TanahExport;
use Exception;
use Throwable;
use App\Models\KibTanah;
use App\Traits\ApiResponer;
use Illuminate\Http\Request;
use App\Services\TanahService;
use App\Imports\KibTanahImport;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Requests\KibTanahRequest;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class KibTanahController extends Controller
{
    use ApiResponer;

    protected $TanahService;

    public function __construct(TanahService $service)
    {
        $this->TanahService = $service;
    }
    public function index(Request $request)
    {
        try {
            $search = $request->query('search');
            $data = $this->TanahService->getAll($search);
            return $this->successResponse($data, 'Data Tanah berhasil diambil', 200);
        } catch (ModelNotFoundException $e) {
            return $this->errorResponse('Data tanah tidak ditemukan', 404);
        } catch (Throwable $e) {
            return $this->errorResponse('Terjadi kesalahan pada server', 500);
        }
    }

    public function store(KibTanahRequest $request)
    {
        $data = $this->TanahService->create($request->validated());
        return $this->successResponse($data, 'Data Tanah berhasil Ditambahkan', 200);
    }

    public function show($id)
    {
        try {
            $data = $this->TanahService->getById($id);
            return $this->successResponse($data, 'Detail Data Berhasil ditemukan', 200);
        } catch (ModelNotFoundException $e) {
            return $this->errorResponse('Data tanah dengan ID tersebut tidak ditemukan', 404);
        } catch (Exception $e) {
            return $this->errorResponse('Terjadi kesalahan pada server', 500);
        }
    }

    public function update(KibTanahRequest $request, $id)
    {
        $data = $this->TanahService->update($id, $request->validated());
        return $this->successResponse($data, 'Data Tanah berhasil Diupdate', 200);
    }


    public function destroy($id)
    {
        $this->TanahService->delete($id);
        return $this->successResponse(null, 'Data Tanah berhasil Dihapus', 200);
    }

    public function importExcel(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls|max:5120'
        ]);

        Excel::import(new KibTanahImport, $request->file('file'));

        return response()->json([
            'message' => 'Data KIB Tanah berhasil diimport'
        ]);
    }

    public function pdf()
    {
        $data = KibTanah::orderBy('nama_barang')->get();

        $pdf = Pdf::loadView('exports.kib_tanah_pdf', compact('data'))
            ->setPaper('a2', 'landscape');

        return response()->streamDownload(
            fn() => print($pdf->output()),
            'kib_tanah.pdf',
            ['Content-Type' => 'application/pdf']
        );
    }

    public function excel()
    {
        return Excel::download(
            new TanahExport,
            'kib_tanah.xlsx'
        );
    }
}
