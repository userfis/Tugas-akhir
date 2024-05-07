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
        Schema::create('berkas', function (Blueprint $table) {
            $table->id();
            $table->string('kode_data');
            $table->string('nomor_data');
            $table->date('tanggal_arsip');
            $table->string('nama_data');
            $table->string('perihal');
            $table->string('file');
            $table->string('tindakan')->nullable();
            $table->string('status')->nullable();
            $table->string('pesan')->nullable();
            $table->string('rak_id')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('berkas');
    }
};
