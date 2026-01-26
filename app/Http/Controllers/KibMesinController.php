<?php

namespace App\Http\Controllers;

use Exception;
use Throwable;
use App\Models\KibMesin;
use App\Traits\ApiResponer;
use Illuminate\Http\Request;
use App\Services\MesinService;
use App\Imports\KibMesinImport;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Requests\KibMesinRequest;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class KibMesinController extends Controller
{
    use ApiResponer;

    protected $MesinService;

    public function __construct(MesinService $service)
    {
        $this->MesinService = $service;
    }
    public function index(Request $request)
    {
        try {
            $search = $request->query('search');

            $data = $this->MesinService->getAll($search);
            return $this->successResponse($data, 'Data Tanah berhasil diambil', 200);
        } catch (ModelNotFoundException $e) {
            return $this->errorResponse('Data tanah tidak ditemukan', 404);
        } catch (Throwable $e) {
            return $this->errorResponse('Terjadi kesalahan pada server', 500);
        }
    }

    public function store(KibMesinRequest $request)
    {
        $data = $this->MesinService->create($request->validated());
        return $this->successResponse($data, 'Data Tanah berhasil Ditambahkan', 200);
    }

    public function show($id)
    {
        try {
            $data = $this->MesinService->getById($id);
            return $this->successResponse($data, 'Detail Data Berhasil ditemukan', 200);
        } catch (ModelNotFoundException $e) {
            return $this->errorResponse('Data tanah dengan ID tersebut tidak ditemukan', 404);
        } catch (Exception $e) {
            return $this->errorResponse('Terjadi kesalahan pada server', 500);
        }
    }

    public function update(KibMesinRequest $request, $id)
    {
        $data = $this->MesinService->update($id, $request->validated());
        return $this->successResponse($data, 'Data Tanah berhasil Diupdate', 200);
    }


    public function destroy($id)
    {
        $this->MesinService->delete($id);
        return $this->successResponse(null, 'Data Tanah berhasil Dihapus', 200);
    }

    public function importExcel(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls|max:5120'
        ]);

        try {
            Excel::import(new KibMesinImport, $request->file('file'));

            return response()->json([
                'status' => 'Success',
                'message' => 'Data KIB Mesin berhasil diimport'
            ], 200);
        } catch (\Throwable $e) {
            return response()->json([
                'status' => 'Error',
                'message' => $e->getMessage()   // 🔥 tampilkan error asli
            ], 500);
        }
    }
}
