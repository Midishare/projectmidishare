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
        Schema::create('slidebukupintarwh', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->json('file_paths')->nullable(); // Kolom JSON untuk menyimpan path gambar
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('slidebukupintarwh');
    }
};
