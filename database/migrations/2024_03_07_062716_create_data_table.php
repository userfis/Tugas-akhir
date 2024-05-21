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
        Schema::create('data', function (Blueprint $table) {
            $table->id();
            $table->foreignId('kategori_id');
            $table->foreignId('data_id');
            $table->date('tanggal');
            $table->string('nomor_agenda');
            $table->string('nomor_surat');
            $table->string('asal_surat');
            $table->string('perihal');
            $table->string('lampiran');
            $table->string('file');
            $table->string('tindakan')->nullable();
            $table->string('disposisi')->nullable();
            $table->string('status')->nullable();
            $table->string('pesan')->nullable();
            // $table->string('rak_id')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('data');
    }
};
