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
        Schema::create('repositorykmwh', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('judulrepowh')->nullable();
            $table->string('gambarrepowh')->nullable();
            $table->string('dokumenfilerepowh')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('repositorykmogm');
    }
};
