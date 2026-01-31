<?php

namespace App\Http\Controllers;

use App\Services\BeritaService;
use App\Traits\ApiResponer;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use PhpParser\Node\Expr\Throw_;
use Throwable;

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
            return $this->successResponse($data, 'Data Tanah berhasil diambil', 200);
        } catch (ModelNotFoundException $e) {
            return $this->errorResponse('Data tanah tidak ditemukan', 404);
        } catch (Throwable $e) {
            return $this->errorResponse('Terjadi kesalahan pada server', 500);
        }
    }
}
