<?php

namespace App\Services;

use App\Models\Kir;
use Illuminate\Support\Facades\Storage;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class KirService
{
    public function getAll()
    {
        return Kir::latest()->get();
    }

    public function store(array $data): Kir
    {
        $kir = Kir::create($data);

        // Generate QR
        $qrData = url('/kir/' . $kir->id);
        $qrName = 'qr_' . time() . '_' . $kir->id . '.svg';
        $qrPath = 'qrcodes/' . $qrName;

        $qrImage = QrCode::format('svg')->size(300)->generate($qrData);
        Storage::disk('public')->put($qrPath, $qrImage);

        $kir->update([
            'gambar_qr' => $qrPath
        ]);


        return $kir;
    }
    public function update(Kir $kir, array $data): Kir
    {
        // ❗ Jangan sentuh gambar_qr
        unset($data['gambar_qr']);

        // Pastikan hanya 1 relasi KIB aktif
        $data['tanah_id']  = $data['tanah_id']  ?? null;
        $data['gedung_id'] = $data['gedung_id'] ?? null;
        $data['mesin_id']  = $data['mesin_id']  ?? null;

        $kir->update($data);

        return $kir;
    }

    public function getById($id)
    {
        return Kir::findOrFail($id);
    }

    /**
     * DELETE KIR + QR
     */
    public function delete(Kir $kir): void
    {
        if ($kir->gambar_qr && Storage::disk('public')->exists($kir->gambar_qr)) {
            Storage::disk('public')->delete($kir->gambar_qr);
        }

        $kir->delete();
    }
}
