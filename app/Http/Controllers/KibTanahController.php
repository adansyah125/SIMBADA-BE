<?php

namespace App\Http\Controllers;

use Exception;
use Throwable;
use App\Models\KibTanah;
use App\Traits\ApiResponer;
use Illuminate\Http\Request;
use App\Services\TanahService;
use App\Imports\KibTanahImport;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Requests\KibTanahRequest;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class KibTanahController extends Controller
{
    use ApiResponer;

    protected $TanahService;

    public function __construct(TanahService $service)
    {
        $this->TanahService = $service;
    }
    public function index()
    {
        try {
            $data = $this->TanahService->getAll();
            return $this->successResponse($data, 'Data Tanah berhasil diambil', 200);
        } catch (ModelNotFoundException $e) {
            return $this->errorResponse('Data tanah tidak ditemukan', 404);
        } catch (Throwable $e) {
            return $this->errorResponse('Terjadi kesalahan pada server', 500);
        }
    }

    public function store(KibTanahRequest $request)
    {
        $data = $this->TanahService->create($request->validated(), $request);
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
        $data = $this->TanahService->update($id, $request->validated(), $request);
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
}
