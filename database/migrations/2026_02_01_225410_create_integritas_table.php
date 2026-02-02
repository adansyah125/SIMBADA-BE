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
        Schema::create('integritas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('mesin_id')->constrained('kib_mesins')->onDelete('cascade');
            $table->string('nama');
            $table->string('nip');
            $table->string('jabatan');
            $table->integer('jumlah');
            $table->date('tanggal');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('integritas');
    }
};
