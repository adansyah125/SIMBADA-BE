<?php

namespace App\Http\Controllers;

use Exception;
use Throwable;
use App\Models\KibGedung;
use App\Traits\ApiResponer;
use Illuminate\Http\Request;
use App\Services\GedungService;
use App\Http\Requests\GedungRequest;
use App\Imports\KibGedungImport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class KibGedungController extends Controller
{
    use ApiResponer;

    protected $GedungService;

    public function __construct(GedungService $service)
    {
        $this->GedungService = $service;
    }
    public function index()
    {
        try {
            $data = $this->GedungService->getAll();
            return $this->successResponse($data, 'Data Tanah berhasil diambil', 200);
        } catch (ModelNotFoundException $e) {
            return $this->errorResponse('Data tanah tidak ditemukan', 404);
        } catch (Throwable $e) {
            return $this->errorResponse('Terjadi kesalahan pada server', 500);
        }
    }

    public function store(GedungRequest $request)
    {
        $data = $this->GedungService->create($request->validated(), $request);
        return $this->successResponse($data, 'Data Tanah berhasil Ditambahkan', 200);
    }

    public function show($id)
    {
        try {
            $data = $this->GedungService->getById($id);
            return $this->successResponse($data, 'Detail Data Berhasil ditemukan', 200);
        } catch (ModelNotFoundException $e) {
            return $this->errorResponse('Data tanah dengan ID tersebut tidak ditemukan', 404);
        } catch (Exception $e) {
            return $this->errorResponse('Terjadi kesalahan pada server', 500);
        }
    }

    public function update(GedungRequest $request, $id)
    {
        $data = $this->GedungService->update($id, $request->validated(), $request);
        return $this->successResponse($data, 'Data Tanah berhasil Diupdate', 200);
    }


    public function destroy($id)
    {
        $this->GedungService->delete($id);
        return $this->successResponse(null, 'Data Tanah berhasil Dihapus', 200);
    }


    public function importExcel(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls|max:5120'
        ]);

        Excel::import(new KibGedungImport, $request->file('file'));

        return response()->json([
            'message' => 'Data KIB Tanah berhasil diimport'
        ]);
    }
}
