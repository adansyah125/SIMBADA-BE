<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('kib_mesins', function (Blueprint $table) {
            $table->id();
            $table->string('kode_barang');
            $table->string('nama_barang');
            $table->string('nibar')->nullable();
            $table->string('no_register')->nullable();
            $table->string('spesifikasi_nama_barang')->nullable();
            $table->string('spesifikasi_lainnya')->nullable();
            $table->string('merk')->nullable();
            $table->string('lokasi')->nullable();
            // Kendaraan Dinas
            $table->string('no_polisi')->nullable();
            $table->string('no_rangka')->nullable();
            $table->string('no_bpkb')->nullable();
            $table->string('jumlah')->nullable();
            $table->string('satuan')->nullable();
            $table->decimal('harga_satuan', 18, 2)->nullable();
            $table->decimal('nilai_perolehan', 18, 2)->nullable();
            $table->string('cara_perolehan')->nullable();
            $table->date('tanggal_perolehan')->nullable();
            $table->string('status_penggunaan')->nullable();
            $table->text('keterangan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kib_mesins');
    }
};
