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
        Schema::create('kib_tanahs', function (Blueprint $table) {
            $table->id();
            $table->string('kode_barang');
            $table->string('nama_barang');
            $table->string('nibar')->nullable();
            $table->string('no_register')->nullable();
            $table->string('spesifikasi_nama_barang')->nullable();
            $table->string('spesifikasi_lainnya')->nullable();
            $table->string('jumlah')->nullable();
            $table->string('satuan')->nullable();
            $table->string('lokasi')->nullable();
            $table->string('titik_koordinat')->nullable();
            // Bukti Kepemilikan
            $table->string('nama')->nullable();
            $table->string('nomor')->nullable();
            $table->date('tanggal')->nullable();
            $table->string('nama_kepemilikan')->nullable();
            $table->decimal('harga_satuan', 18, 2)->nullable();
            $table->decimal('nilai_perolehan', 18, 2)->nullable();
            $table->date('tanggal_perolehan')->nullable();
            $table->string('cara_perolehan')->nullable();
            $table->string('status_penggunaan')->nullable();
            $table->text('keterangan')->nullable();
            $table->string('gambar')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kib_tanahs');
    }
};
