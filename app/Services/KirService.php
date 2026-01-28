<?php

namespace App\Services;

use App\Models\Kir;
use Illuminate\Support\Facades\Storage;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class KirService
{
    public function getAll($search = null)
    {
        $query = Kir::query();

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('nama_barang', 'like', "%{$search}%")
                    ->orWhere('kode_barang', 'like', "%{$search}%");
            });
        }

        return $query->latest()->paginate(10);
    }

    public function store(array $data, $request = null): Kir
    {

        if ($request && $request->hasFile('gambar')) {
            $path = $request->file('gambar')->store('kir', 'public');
            $data['gambar'] = $path;
        }

        if (empty($data['kode_barang'])) {
            throw new \Exception("Kolom kode_barang tidak boleh kosong.");
        }

        $kir = Kir::create($data);
        // Generate QR
        $qrData = url('/label/' . $kir->id);
        $qrName = 'qr_' . time() . '_' . $kir->id . '.svg';
        $qrPath = 'qrcodes/' . $qrName;

        $qrImage = QrCode::format('svg')->size(300)->generate($qrData);
        Storage::disk('public')->put($qrPath, $qrImage);

        $kir->update([
            'gambar_qr' => $qrPath
        ]);


        return $kir;
    }
    public function update(Kir $kir, array $data, $request = null): Kir
    {
        // ❗ Jangan sentuh gambar_qr
        unset($data['gambar_qr']);

        // Pastikan hanya 1 relasi KIB aktif
        $data['tanah_id']  = $data['tanah_id']  ?? null;
        $data['gedung_id'] = $data['gedung_id'] ?? null;
        $data['mesin_id']  = $data['mesin_id']  ?? null;

        if ($request && $request->hasFile('gambar')) {
            // 1. Hapus gambar lama jika ada di storage
            if ($kir->gambar) {
                Storage::disk('public')->delete($kir->gambar);
            }

            // 2. Simpan gambar baru
            $data['gambar'] = $request->file('gambar')->store('kir', 'public');
        }

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
