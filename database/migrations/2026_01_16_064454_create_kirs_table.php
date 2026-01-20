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
        Schema::create('kirs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tanah_id')->nullable()->constrained('kib_tanahs')->onDelete('cascade');
            $table->foreignId('gedung_id')->nullable()->constrained('kib_gedungs')->onDelete('cascade');
            $table->foreignId('mesin_id')->nullable()->constrained('kib_mesins')->onDelete('cascade');
            $table->string('nama_barang');
            $table->string('kode_barang');
            $table->date('tanggal_perolehan');
            $table->string('lokasi');
            $table->enum('kondisi', ['baik', 'kurang baik', 'rusak berat'])->default('baik');
            $table->integer('jumlah');
            $table->decimal('nilai_perolehan', 18, 2);
            $table->string('gambar_qr')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kirs');
    }
};
