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
        Schema::create('incoming_raw_materials', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid');
            $table->foreignId('material_id')->constrained('raw_materials')->onDelete('cascade');
            $table->date('tanggal_pembelian');
            $table->string('unit');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bahan_baku_masuk');
    }
};
