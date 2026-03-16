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
        Schema::create('kurs_mata_uang', function (Blueprint $table) {
            $table->id();

            // Kita buat kolom persis seperti di PHP Native kemarin
            $table->string('mata_uang');
            $table->string('bendera')->nullable(); // nullable() artinya boleh kosong/tidak wajib
            $table->double('harga_beli');
            $table->double('harga_jual');
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kurs_mata_uang');
    }
};
